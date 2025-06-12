<!DOCTYPE html>
<html>

<head>
    <title>Learner Progress Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #f4f4f4;
        }

        select {
            margin-top: 20px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <h1>Learner Progress Dashboard</h1>

    <!-- 🔽 Course Filter Dropdown -->
    <label for="courseFilter">Filter by Course:</label>
    <select id="courseFilter">
        <option value="">-- All Courses --</option>
        @foreach ($courses as $course)
            <option value="{{ $course->name }}">{{ $course->name }}</option>
        @endforeach
    </select>
    <label for="sortProgress">Sort by Progress:</label>
    <select id="sortProgress">
        <option value="">-- No Sorting --</option>
        <option value="asc">Progress: Low to High</option>
        <option value="desc">Progress: High to Low</option>
    </select>
    <!-- 📊 Dynamic Table -->
    <div id="dashboard"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const courseFilter = document.getElementById('courseFilter');
            const dashboard = document.getElementById('dashboard');
            const sortProgress = document.getElementById('sortProgress');

            function loadLearners(course = '', sortOrder = '') {
                const url = course ? `/learners?course=${encodeURIComponent(course)}` : '/learners';
                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        // 🔽 Apply sorting if specified
                        if (sortOrder === 'asc') {
                            data.sort((a, b) => a.progress - b.progress);
                        } else if (sortOrder === 'desc') {
                            data.sort((a, b) => b.progress - a.progress);
                        }

                        let html = `
                <table>
                    <thead>
                        <tr>
                            <th>Learner</th>
                            <th>Courses Enrolled</th>
                            <th>Progress (%)</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

                        data.forEach(l => {
                            html += `
                    <tr>
                        <td>${l.name}</td>
                        <td>${l.courses.join(', ')}</td>
                        <td>${l.progress}%</td>
                    </tr>
                `;
                        });

                        html += '</tbody></table>';
                        dashboard.innerHTML = html;
                    });
            }
            function reload() {
                loadLearners(courseFilter.value, sortProgress.value);
            }
            // 🌀 Initial load
            reload();

            // 🔁 Load when dropdown changes
            courseFilter.addEventListener('change', reload);
            sortProgress.addEventListener('change', reload);
        });
    </script>
</body>

</html>