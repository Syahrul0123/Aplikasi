<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if this is a file upload
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $uploadDirectory = 'file/';

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $originalFilePath = $uploadDirectory . basename($file['name']);

        // Validate file type
        $allowedTypes = ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf'];
        if (!in_array($file['type'], $allowedTypes)) {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid file type. Only .doc, .docx, and .pdf files are allowed.']);
            exit;
        }
        // Move the uploaded file to the server
        if (move_uploaded_file($file['tmp_name'], $originalFilePath)) {
            // Generate a new file name using the current date and time
            $pathInfo = pathinfo($originalFilePath);
            $newFileName = date('Ymd_His') . '.' . $pathInfo['extension'];
            $newFilePath = $uploadDirectory . $newFileName;

            // Rename the file
            if (rename($originalFilePath, $newFilePath)) {
                echo json_encode(['message' => 'File uploaded and renamed successfully!', 'filePath' => $newFilePath]);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'File uploaded but renaming failed.']);
            }
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'File upload failed.']);
        }
    } else {
        // Handle JSON input for file deletion
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['action']) && $data['action'] === 'delete' && isset($data['filePath'])) {
            $filePath = $data['filePath'];
            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    echo json_encode(['message' => 'File deleted successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['message' => 'File deletion failed']);
                }
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'File not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid request']);
        }
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed']);
}
