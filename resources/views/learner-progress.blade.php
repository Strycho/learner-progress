<!DOCTYPE html>
<html>
<head>
    <title>Learner Progress Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background-color: #f4f4f4; }
        select { margin-top: 20px; padding: 5px; }
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

    <!-- 📊 Dynamic Table -->
    <div id="dashboard"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const courseFilter = document.getElementById('courseFilter');
            const dashboard = document.getElementById('dashboard');

            function loadLearners(course = '') {
                const url = course ? `/api/learners?course=${encodeURIComponent(course)}` : '/api/learners';
                fetch(url)
                    .then(res => res.json())
                    .then(data => {
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

            // 🌀 Initial load
            loadLearners();

            // 🔁 Load when dropdown changes
            courseFilter.addEventListener('change', function () {
                loadLearners(this.value);
            });
        });
    </script>
</body>
</html>
