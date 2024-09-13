<?php

class ProfileEdit
{
    use Controller;

    public function index()
    {
        // Check if userId is set in the session
        if (!isset($_SESSION['userId'])) {
            // Redirect to login if userId is not set
            header('Location: ' . ROOT . '/Login');
            exit();
        }

        $userId = $_SESSION['userId'];

        // Fetch user details from the model
        $userModel = new User();
        $user = $userModel->getUserById($userId);

        if (!$user) {
            echo "User not found";
            exit();
        }

        // Pass the user data to the profile view
        $data['user'] = $user;

        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and process form data
            $updatedData = [
                'userName' => $_POST['fullName'],
                'email' => $_POST['emailAddress'],
                'phoneNo' => $_POST['mobileNumber'],
                'gender' => $_POST['gender'],
                // Handle profile image upload
                'profileImg' => $this->handleProfileImageUpload()
            ];

            // Update user data
            if ($userModel->updateUser($userId, $updatedData)) {
                // Redirect to profile page with success message
                header('Location: ' . ROOT . '/Profile');
                exit();
            } else {
                echo "Failed to update user profile";
            }
        }

        $this->view('Customer/User/ProfileEdit', $data);
    }

    private function handleProfileImageUpload()
    {
        // Define the upload directory
        $uploadDir = 'C:/xampp/htdocs/CinemaManagementSystem/public/assets/images/';

        if (isset($_FILES['profileImg']) && $_FILES['profileImg']['error'] === UPLOAD_ERR_OK) {
            $uploadFile = $uploadDir . basename($_FILES['profileImg']['name']);

            // Attempt to move the uploaded file to the designated directory
            if (move_uploaded_file($_FILES['profileImg']['tmp_name'], $uploadFile)) {
                return basename($_FILES['profileImg']['name']);
            } else {
                echo "File upload failed";
                return $_POST['existingProfileImg'] ?? 'defaultProfile.jpg';
            }
        }

        // Return the existing profile image if upload fails
        return $_POST['existingProfileImg'] ?? 'defaultProfile.jpg';
    }
}