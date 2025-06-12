<!DOCTYPE html>
<html>
<head>
    <title>Learner Progress Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Learner Progress Dashboard</h1>
    <div id="dashboard">
        <!-- Table will be loaded here via JS -->
    </div>

    <script>
        fetch('/api/learners')
            .then(response => response.json())
            .then(data => {
                const table = document.createElement('table');
                const header = `
                    <tr>
                        <th>Learner</th>
                        <th>Courses Enrolled</th>
                        <th>Progress (%)</th>
                    </tr>`;
                table.innerHTML = header + data.map(l => `
                    <tr>
                        <td>${l.name}</td>
                        <td>${l.courses.join(', ')}</td>
                        <td>${l.progress}%</td>
                    </tr>
                `).join('');
                document.getElementById('dashboard').appendChild(table);
            });
    </script>
</body>
</html>
