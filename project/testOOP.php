<?php

define('DATA_FILE', 'users.json');

function loadUsers(): array {
    if (!file_exists(DATA_FILE)) {
        return [];
    }
    return json_decode(file_get_contents(DATA_FILE), true) ?? [];
}

function saveUsers(array $users): void {
    file_put_contents(DATA_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

function input(string $label): string {
    echo $label . ": ";
    return trim(fgets(STDIN));
}

while (true) {
    echo PHP_EOL;
    echo "==== USER CRUD CONSOLE ====" . PHP_EOL;
    echo "1. Create user" . PHP_EOL;
    echo "2. List users" . PHP_EOL;
    echo "3. Update user" . PHP_EOL;
    echo "4. Delete user" . PHP_EOL;
    echo "0. Exit" . PHP_EOL;

    $choice = input("Choose");

    $users = loadUsers();

    switch ($choice) {
        case '1': // CREATE
            $name  = input("Name");
            $email = input("Email");

            $users[] = [
                'id' => uniqid(),
                'name' => $name,
                'email' => $email
            ];

            saveUsers($users);
            echo "User created ✔" . PHP_EOL;
            break;

        case '2': // READ
            if (empty($users)) {
                echo "No users found." . PHP_EOL;
                break;
            }

            foreach ($users as $u) {
                echo "{$u['id']} | {$u['name']} | {$u['email']}" . PHP_EOL;
            }
            break;

        case '3': // UPDATE
            $id = input("User ID to update");

            foreach ($users as &$u) {
                if ($u['id'] === $id) {
                    $u['name']  = input("New name");
                    $u['email'] = input("New email");
                    saveUsers($users);
                    echo "User updated ✔" . PHP_EOL;
                    continue 2;
                }
            }

            echo "User not found ❌" . PHP_EOL;
            break;

        case '4': // DELETE
            $id = input("User ID to delete");

            $filtered = array_filter($users, fn($u) => $u['id'] !== $id);

            if (count($filtered) === count($users)) {
                echo "User not found ❌" . PHP_EOL;
                break;
            }

            saveUsers(array_values($filtered));
            echo "User deleted ✔" . PHP_EOL;
            break;

        case '0':
            exit("Bye 👋" . PHP_EOL);

        default:
            echo "Invalid choice ❌" . PHP_EOL;
    }
}
