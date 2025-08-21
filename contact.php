<?php
// Einfaches Kontaktformular mit Validierung

$errors = [];
$name = '';
$email = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '') {
        $errors['name'] = 'Bitte geben Sie Ihren Namen ein.';
    }

    if ($email === '') {
        $errors['email'] = 'Bitte geben Sie Ihre E-Mail-Adresse ein.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
    }

    if ($message === '') {
        $errors['message'] = 'Bitte geben Sie eine Nachricht ein.';
    }

    if (!$errors) {
        echo '<p>Vielen Dank, ' . htmlspecialchars($name) . '. Ihre Nachricht wurde gesendet.</p>';
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kontaktformular</title>
</head>
<body>
    <form method="post" action="">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <?php if (isset($errors['name'])): ?>
                <span style="color:red"><?php echo $errors['name']; ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="email">E-Mail:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <?php if (isset($errors['email'])): ?>
                <span style="color:red"><?php echo $errors['email']; ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="message">Nachricht:</label>
            <textarea id="message" name="message"><?php echo htmlspecialchars($message); ?></textarea>
            <?php if (isset($errors['message'])): ?>
                <span style="color:red"><?php echo $errors['message']; ?></span>
            <?php endif; ?>
        </div>
        <button type="submit">Senden</button>
    </form>
</body>
</html>
