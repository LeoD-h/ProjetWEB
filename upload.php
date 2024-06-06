<?php
include_once ("libs/modele.php");
include_once ("libs/maLibUtils.php"); // tprint
include_once ("libs/maLibForms.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpeg', 'jpg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        $idVet = $_POST['hiddenInput'];

        if (in_array($filetype, $allowed)) {
            $newFilename = 'uploads/' . $idVet . '.' . $filetype;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $newFilename)) {
                echo json_encode(['filePath' => $newFilename]);
                
                exit;
            } else {
                echo json_encode(['error' => 'Failed to move uploaded file. Check the permissions of the uploads directory.']);
                exit;
            }
        } else {
            echo json_encode(['error' => 'Invalid file type.']);
            exit;
        }
    } else {
        echo json_encode(['error' => 'No file uploaded or upload error.']);
        exit;
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
    exit;
}
?>
