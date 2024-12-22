<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Score APIs</title>
</head>
<body>
    <h1>Test Score APIs</h1>

    <!-- List all scores -->
    <h2>Get All Scores</h2>
    <button id="get-scores">Get Scores</button>
    <pre id="get-scores-result"></pre>

    <!-- Add a new score -->
    <h2>Create Score</h2>
    <form id="create-score-form">
        <label for="create-user-id">User ID:</label>
        <input type="number" id="create-user-id" name="user_id" required>
        <label for="create-username">Username:</label>
        <input type="text" id="create-username" name="username" required>
        <label for="create-score">Score:</label>
        <input type="number" id="create-score" name="score" required>
        <button type="submit">Create Score</button>
    </form>
    <pre id="create-score-result"></pre>

    <!-- Get a specific score -->
    <h2>Get Score by Username</h2>
    <form id="get-score-form">
        <label for="get-username">Username:</label>
        <input type="text" id="get-username" name="username" required>
        <button type="submit">Get Score</button>
    </form>
    <pre id="get-score-result"></pre>

    <!-- Update a score -->
    <h2>Update Score by Username</h2>
    <form id="update-score-form">
        <label for="update-username">Username:</label>
        <input type="text" id="update-username" name="username" required>
        <label for="update-score">New Score:</label>
        <input type="number" id="update-score" name="score" required>
        <button type="submit">Update Score</button>
    </form>
    <pre id="update-score-result"></pre>

    <!-- Delete a score -->
    <h2>Delete Score by Username</h2>
    <form id="delete-score-form">
        <label for="delete-username">Username:</label>
        <input type="text" id="delete-username" name="username" required>
        <button type="submit">Delete Score</button>
    </form>
    <pre id="delete-score-result"></pre>

    <script>
        const apiUrl = '/api';

        // Get all scores
        document.getElementById('get-scores').addEventListener('click', async () => {
            try {
                const response = await fetch(`${apiUrl}/scores`);
                const result = await response.json();
                document.getElementById('get-scores-result').innerText = JSON.stringify(result, null, 2);
            } catch (error) {
                console.error(error);
            }
        });

        // Create a new score
        document.getElementById('create-score-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const data = {
                user_id: document.getElementById('create-user-id').value,
                username: document.getElementById('create-username').value,
                score: document.getElementById('create-score').value,
            };
            try {
                const response = await fetch(`${apiUrl}/scores`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data),
                });
                const result = await response.json();
                document.getElementById('create-score-result').innerText = JSON.stringify(result, null, 2);
            } catch (error) {
                console.error(error);
            }
        });

        // Get a specific score
        document.getElementById('get-score-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('get-username').value;
            try {
                const response = await fetch(`${apiUrl}/scores/${username}`);
                const result = await response.json();
                document.getElementById('get-score-result').innerText = JSON.stringify(result, null, 2);
            } catch (error) {
                console.error(error);
            }
        });

        // Update a score
        document.getElementById('update-score-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('update-username').value;
            const data = { score: document.getElementById('update-score').value };
            try {
                const response = await fetch(`${apiUrl}/scores/${username}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data),
                });
                const result = await response.json();
                document.getElementById('update-score-result').innerText = JSON.stringify(result, null, 2);
            } catch (error) {
                console.error(error);
            }
        });

        // Delete a score
        document.getElementById('delete-score-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('delete-username').value;
            try {
                const response = await fetch(`${apiUrl}/scores/${username}`, {
                    method: 'DELETE',
                });
                const result = await response.json();
                document.getElementById('delete-score-result').innerText = JSON.stringify(result, null, 2);
            } catch (error) {
                console.error(error);
            }
        });
    </script>
</body>
</html>
