<?php

namespace App\Factory;

use App\core\Controller;
use App\core\Database;
use App\models\Admin;
use App\models\User;


class UserFactory {
    use Controller;
    private $entityManager;
    private $userRepository;
    private $adminRepository;

    private $maxFailedAttempts = 3;
    private $lockoutDuration = 60; // 1 minutes in seconds for testing
    public function __construct()
    {
        // Initialize EntityManager and User repository
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->adminRepository = $this->entityManager->getRepository(Admin::class);

    }

    public static function createUser($userType, $userId, $userName,
                                      $phoneNo, $password, $role, $coins, $profileImg,
                                      $status, $birthDate, $gender) {
        switch ($userType) {
            case 'admin':
                {
                $admin =  new Admin();
                $admin->setUserId($userId);
                $admin->setUserName($userName);
                $admin->setPhoneNo($phoneNo);
                $admin->setPassword($password);
                $admin->setRole($role);
                return $admin;
                }
            case 'user':
            default:
                return new User($userId, $userName, $phoneNo, $password, $coins, $profileImg, $status, $birthDate, $gender);
        }
    }

    public function login($userType, $phoneNo, $password) {
        $result = [];

        // Check if the admin is locked out
        if ($this->isLockedOut($phoneNo)) {
            $result['error'] = "Your account is locked. Please try again after 1 minute.";
            return $result;
        }

        if ($userType === 'admin') {
            // Admin login logic
            $admin = $this->adminRepository->findOneBy(['phoneNo' => $phoneNo]);

            if ($admin && password_verify($password, $admin->getPassword())) {
                // Destroy any previous session (S.C [Establish a new session after successful login])
                session_destroy();
                // Start a new session
                session_start();
                session_regenerate_id(true); // Generate a new session ID

                $user = UserFactory::createUser('admin', $admin->getUserId(), $admin->getUserName(), $admin->getPhoneNo(), $admin->getPassword(), $admin->getRole(), null, null, null, null, null);

                $_SESSION['admin'] = [
                    'userId' => $admin->getUserId(),
                    'userName' => $admin->getUserName(),
                    'role' => $admin->getRole(),
                ];

                // Set last activity time for session management (S.C)
                $_SESSION['last_activity'] = time();

                // Reset failed attempts on successful login
                $this->resetFailedAttempts($phoneNo);

                $result['success_message'] = "Login successful. Redirecting to Admin Profile...";
                $result['user'] = $user;
            } else {
                // Increment failed attempts
                $this->incrementFailedAttempts($phoneNo);
                $result['error'] = "Invalid phone number or password for admin.";
            }
        } else {
            // User login logic
            $user = $this->userRepository->findOneBy(['phoneNo' => $phoneNo]);

            if ($user) {
                if ($user->getStatus() === 'deactive') {
                    $result['error'] = "Your account is deactivated. Please contact support.";
                } else if (password_verify($password, $user->getPassword())) {
                    $_SESSION['userId'] = $user->getUserId();
                    $result['user'] = [
                        'userId' => $user->getUserId(),
                        'profileImg' => $user->getProfileImg(),
                        'userName' => $user->getUserName(),
                        'phoneNo' => $user->getPhoneNo(),
                        'email' => $user->getEmail(),
                        'gender' => $user->getGender(),
                        'birthDate' => $user->getBirthDate(),
                        'coins' => $user->getCoins()
                    ];

                    $result['success_message'] = "Login successful. Redirecting to User Profile...";
                } else {
                    $result['error'] = "Invalid phone number or password for user.";
                }
            } else {
                $result['error'] = "User not found.";
            }
        }

        return $result;
    }

    private function isLockedOut($phoneNo) {
        // Check if there is a lockout record in the session
        if (isset($_SESSION['lockout'][$phoneNo])) {
            $lockout = $_SESSION['lockout'][$phoneNo];

            if ($lockout['attempts'] >= $this->maxFailedAttempts) {
                $timeElapsed = time() - $lockout['lastAttemptTime'];

                if ($timeElapsed < $this->lockoutDuration) {
                    return true;
                } else {
                    // Reset failed attempts after lockout duration
                    $this->resetFailedAttempts($phoneNo);
                }
            }
        }

        return false;
    }

    private function incrementFailedAttempts($phoneNo) {
        if (!isset($_SESSION['lockout'][$phoneNo])) {
            $_SESSION['lockout'][$phoneNo] = [
                'attempts' => 1,
                'lastAttemptTime' => time()
            ];
        } else {
            $_SESSION['lockout'][$phoneNo]['attempts']++;
            $_SESSION['lockout'][$phoneNo]['lastAttemptTime'] = time();
        }
    }

    private function resetFailedAttempts($phoneNo) {
        if (isset($_SESSION['lockout'][$phoneNo])) {
            unset($_SESSION['lockout'][$phoneNo]);
        }
    }

    public function register($user) {

        // Persist user data
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Redirect to login page or success page
        return 'Registration successful. Please log in.';


    }

    public function changePassword($user, $currentPass, $newPass, $confirmPass)
    {
        // Validate current password
        if (!password_verify($currentPass, $user->getPassword())) {
            $_SESSION['error'] = 'Current password is incorrect';
        } elseif ($newPass !== $confirmPass) {
            // Check if new passwords match
            $_SESSION['error'] = 'New passwords do not match';
        } else {
            // Update password
            $user->setPassword(password_hash($newPass, PASSWORD_BCRYPT));
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $_SESSION['success_message'] = 'Password successfully changed';
            return true; // Password change successful
        }

        return false; // Password change failed
    }

}