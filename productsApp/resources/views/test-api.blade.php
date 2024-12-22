<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test API</title>
    <!-- Removed CSRF Token as it's not needed for API routes -->
    <style>
        /* Basic styling for better readability */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        label {
            display: inline-block;
            width: 150px;
            margin-bottom: 10px;
        }
        input {
            padding: 5px;
            margin-bottom: 10px;
            width: 200px;
        }
        button {
            padding: 5px 10px;
        }
        .result {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            white-space: pre-wrap; /* Preserve formatting */
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Test API Endpoints</h1>

    <!-- Login Form -->
    <h2>Login</h2>
    <form id="login-form">
        <label for="login-username">Username:</label>
        <input type="text" id="login-username" name="username" required><br>
        <label for="login-password">Password:</label>
        <input type="password" id="login-password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <div id="login-result" class="result"></div>

    <!-- Form to create a new user -->
    <h2>Create User</h2>
    <form id="create-user-form">
        <label for="create-username">Username:</label>
        <input type="text" id="create-username" name="username" required><br>
        <label for="create-password">Password:</label>
        <input type="password" id="create-password" name="password" required><br>
        <label for="create-credit">Credit:</label>
        <input type="number" id="create-credit" name="credit" required><br>
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" name="startDate" required><br>
        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" name="endDate" required><br>
        <label for="create-type">Type:</label>
        <input type="number" id="create-type" name="type" required><br>
        <button type="submit">Create User</button>
    </form>
    <div id="create-user-result" class="result"></div>

    <!-- Form to get a user -->
    <h2>Get User</h2>
    <form id="get-user-form">
        <label for="get-username">Username:</label>
        <input type="text" id="get-username" name="username" required><br>
        <button type="submit">Get User</button>
    </form>
    <div id="get-user-result" class="result"></div>

    <!-- Form to update a user -->
    <h2>Update User</h2>
    <form id="update-user-form">
        <label for="update-username">Username:</label>
        <input type="text" id="update-username" name="username" required><br>
        <label for="update-password">New Password:</label>
        <input type="password" id="update-password" name="password" required><br>
        <label for="update-credit">New Credit:</label>
        <input type="number" id="update-credit" name="credit" required><br>
        <button type="submit">Update User</button>
    </form>
    <div id="update-user-result" class="result"></div>

    <!-- Form to delete a user -->
    <h2>Delete User</h2>
    <form id="delete-user-form">
        <label for="delete-username">Username:</label>
        <input type="text" id="delete-username" name="username" required><br>
        <button type="submit">Delete User</button>
    </form>
    <div id="delete-user-result" class="result"></div>

    <!-- List all users -->
    <h2>List All Users</h2>
    <button id="list-users">List Users</button>
    <div id="list-users-result" class="result"></div>

    <script>
        const apiUrl = '/api'; // Base API URL

        // Login
        document.getElementById('login-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const data = {
                username: document.getElementById('login-username').value,
                password: document.getElementById('login-password').value
            };
            try {
                const response = await fetch(`${apiUrl}/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        // Removed CSRF token as it's not needed for API routes
                    },
                    body: JSON.stringify(data),
                });
                const result = await response.json();
                if (response.ok) {
                    // Display the user data returned by the login API
                    document.getElementById('login-result').innerHTML = `
                        <p>Login Successful!</p>
                        <pre>${JSON.stringify(result, null, 2)}</pre>
                    `;
                } else {
                    // Display error message returned by the API
                    document.getElementById('login-result').innerHTML = `
                        <p class="error">${result.message || 'Login failed.'}</p>
                    `;
                }
            } catch (error) {
                console.error(error);
                document.getElementById('login-result').innerHTML = `<p class="error">An error occurred during login.</p>`;
            }
        });

        // Create user
        document.getElementById('create-user-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const data = {
                username: document.getElementById('create-username').value,
                password: document.getElementById('create-password').value,
                credit: document.getElementById('create-credit').value,
                startDate: document.getElementById('startDate').value,
                endDate: document.getElementById('endDate').value,
                type: document.getElementById('create-type').value
            };
            try {
                const response = await fetch(`${apiUrl}/users`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        // Removed Authorization and CSRF token as they're not needed
                    },
                    body: JSON.stringify(data),
                });
                const result = await response.json();
                if (response.ok) {
                    document.getElementById('create-user-result').innerText = JSON.stringify(result, null, 2);
                } else {
                    document.getElementById('create-user-result').innerHTML = `<p class="error">${result.message || 'Failed to create user.'}</p>`;
                }
            } catch (error) {
                console.error(error);
                document.getElementById('create-user-result').innerHTML = `<p class="error">An error occurred while creating user.</p>`;
            }
        });

        // Get user
        document.getElementById('get-user-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('get-username').value;
            try {
                const response = await fetch(`${apiUrl}/users/${encodeURIComponent(username)}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        // Removed Authorization and CSRF token as they're not needed
                    },
                });
                const result = await response.json();
                if (response.ok) {
                    document.getElementById('get-user-result').innerText = JSON.stringify(result, null, 2);
                } else {
                    document.getElementById('get-user-result').innerHTML = `<p class="error">${result.message || 'Failed to get user.'}</p>`;
                }
            } catch (error) {
                console.error(error);
                document.getElementById('get-user-result').innerHTML = `<p class="error">An error occurred while fetching user.</p>`;
            }
        });

        // Update user
        document.getElementById('update-user-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('update-username').value;
            const data = {
                password: document.getElementById('update-password').value,
                credit: document.getElementById('update-credit').value,
            };
            try {
                const response = await fetch(`${apiUrl}/users/${encodeURIComponent(username)}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        // Removed Authorization and CSRF token as they're not needed
                    },
                    body: JSON.stringify(data),
                });
                const result = await response.json();
                if (response.ok) {
                    document.getElementById('update-user-result').innerText = JSON.stringify(result, null, 2);
                } else {
                    document.getElementById('update-user-result').innerHTML = `<p class="error">${result.message || 'Failed to update user.'}</p>`;
                }
            } catch (error) {
                console.error(error);
                document.getElementById('update-user-result').innerHTML = `<p class="error">An error occurred while updating user.</p>`;
            }
        });

        // Delete user
        document.getElementById('delete-user-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('delete-username').value;
            try {
                const response = await fetch(`${apiUrl}/users/${encodeURIComponent(username)}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        // Removed Authorization and CSRF token as they're not needed
                    },
                });
                const result = await response.json();
                if (response.ok) {
                    document.getElementById('delete-user-result').innerText = JSON.stringify(result, null, 2);
                } else {
                    document.getElementById('delete-user-result').innerHTML = `<p class="error">${result.message || 'Failed to delete user.'}</p>`;
                }
            } catch (error) {
                console.error(error);
                document.getElementById('delete-user-result').innerHTML = `<p class="error">An error occurred while deleting user.</p>`;
            }
        });

        // List all users
        document.getElementById('list-users').addEventListener('click', async () => {
            try {
                const response = await fetch(`${apiUrl}/users`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        // Removed Authorization and CSRF token as they're not needed
                    },
                });
                const result = await response.json();
                if (response.ok) {
                    document.getElementById('list-users-result').innerText = JSON.stringify(result, null, 2);
                } else {
                    document.getElementById('list-users-result').innerHTML = `<p class="error">${result.message || 'Failed to list users.'}</p>`;
                }
            } catch (error) {
                console.error(error);
                document.getElementById('list-users-result').innerHTML = `<p class="error">An error occurred while listing users.</p>`;
            }
        });
    </script>
</body>
</html>
