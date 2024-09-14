<?php

class ProfileEdit
{
    use Controller;

    public function index()
    {
        if (!isset($_SESSION['userId'])) {
            header('Location: ' . ROOT . '/Login');
            exit();
        }

        $userId = $_SESSION['userId'];
        $userModel = new User();
        $user = $userModel->getUserById($userId);

        if (!$user) {
            echo "User not found";
            exit();
        }

        $data['user'] = $user;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize inputs
            $updatedData = [
                'userName' => htmlspecialchars($_POST['fullName']),
                'email' => htmlspecialchars($_POST['emailAddress']),
                'phoneNo' => htmlspecialchars($_POST['mobileNumber']),
                'gender' => htmlspecialchars($_POST['gender']),
                'profileImg' => $this->handleProfileImageUpload()
            ];

            // Perform the update
            $userModel->updateUser($userId, $updatedData);

            // Fetch the updated user data
            $updatedUser = $userModel->getUserById($userId);

            // Check if the updated data matches the newly fetched user data
            if (
                $updatedUser->userName === $updatedData['userName'] &&
                $updatedUser->email === $updatedData['email'] &&
                $updatedUser->phoneNo === $updatedData['phoneNo'] &&
                $updatedUser->gender === $updatedData['gender'] &&
                $updatedUser->profileImg === $updatedData['profileImg']
            ) {
                // Send a success response
                echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
            } else {
                // Send an error response
                echo json_encode(['status' => 'error', 'message' => 'Failed to update profile']);
            }
        }

        $this->view('Customer/User/ProfileEdit', $data);
    }

    private function handleProfileImageUpload()
    {
        $uploadDir = 'C:/xampp/htdocs/CinemaManagementSystem/public/assets/images/';

        if (isset($_FILES['profileImg']) && $_FILES['profileImg']['error'] === UPLOAD_ERR_OK) {
            $uploadFile = $uploadDir . basename($_FILES['profileImg']['name']);
            if (move_uploaded_file($_FILES['profileImg']['tmp_name'], $uploadFile)) {
                return basename($_FILES['profileImg']['name']);
            } else {
                echo "File upload failed";
                return $_POST['existingProfileImg'] ?? 'defaultProfile.jpg';
            }
        }

        return $_POST['existingProfileImg'] ?? 'defaultProfile.jpg';
    }
}