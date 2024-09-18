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

        if ($userType === 'admin') {
            // Admin login logic
            $admin = $this->adminRepository->findOneBy(['phoneNo' => $phoneNo]);

            if ($admin && password_verify($password, $admin->getPassword())) {
                $user = UserFactory::createUser('admin', $admin->getUserId(), $admin->getUserName(), $admin->getPhoneNo(), $admin->getPassword(), $admin->getRole(), null, null, null, null, null);

                $_SESSION['admin'] = [
                    'userId' => $admin->getUserId(),
                    'userName' => $admin->getUserName(),
                    'role' => $admin->getRole(),
                ];

                $result['success_message'] = "Login successful. Redirecting to Admin Profile...";
                $result['user'] = $user;
            } else {
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

    public function register($user) {

        // Persist user data
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Redirect to login page or success page
        return 'Registration successful. Please log in.';


    }
}