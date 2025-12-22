<?php
session_start();
include "config.php";
include "header.php";

// if user inscrit
if(!isset($_SESSION['emai_l'])){
    header("Location: login.php");
    exit();
}

// Total de Cours
$TotalCourses = "SELECT COUNT(*) as total FROM courses";
$resultTotalCourses = mysqli_query($connect, $TotalCourses);
$totalCourses = mysqli_fetch_assoc($resultTotalCourses)['total'];


// Total des Utilisateurs 
$sqlTotalUsers = "SELECT COUNT(*) as total FROM users";
$resultTotalUsers = mysqli_query($connect, $sqlTotalUsers);
$totalUsers = mysqli_fetch_assoc($resultTotalUsers)['total'];

// Total des Inscriptions
$sqlTotalEnrollments = "SELECT COUNT(*) as total FROM enrollments";
$resultTotalEnrollments = mysqli_query($connect, $sqlTotalEnrollments);
$totalEnrollments = mysqli_fetch_assoc($resultTotalEnrollments)['total'];


//   Cours le Plus Populaire 
$sqlPopularCourse = "SELECT courses.title, COUNT(*) as nombre 
                     FROM enrollments 
                     JOIN courses ON courses.id = enrollments.course_id 
                     GROUP BY courses.id 
                     ORDER BY nombre DESC 
                     LIMIT 1";
$resultPopular = mysqli_query($connect, $sqlPopularCourse);
$popularCourse = mysqli_fetch_assoc($resultPopular);


?>


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f3f4f6;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .dashboard-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .dashboard-header h1 {
            color: #1f2937;
            font-size: 36px;
            margin-bottom: 10px;
        }

        .dashboard-header p {
            color: #6b7280;
            font-size: 16px;
        }

        /* KPI Cards Grid */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .kpi-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .kpi-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .kpi-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 15px;
        }

        .kpi-icon.blue { background: #dbeafe; color: #3b82f6; }
        .kpi-icon.green { background: #d1fae5; color: #10b981; }
        .kpi-icon.purple { background: #e9d5ff; color: #8b5cf6; }
        .kpi-icon.orange { background: #fed7aa; color: #f97316; }
        .kpi-icon.red { background: #fee2e2; color: #ef4444; }
        .kpi-icon.yellow { background: #fef3c7; color: #eab308; }

        .kpi-card h3 {
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
        }

        .kpi-number {
            font-size: 36px;
            font-weight: bold;
            color: #1f2937;
            margin-top: 10px;
        }

        .kpi-text {
            color: #1f2937;
            font-size: 18px;
            font-weight: 600;
            margin-top: 10px;
        }

        /* Tables Section */
        .tables-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .table-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .table-section h2 {
            color: #1f2937;
            font-size: 20px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f3f4f6;
            display: flex;
            align-items: center;
        }

        .table-section h2::before {
            content: '📊';
            margin-right: 10px;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #f9fafb;
            padding: 12px;
            text-align: left;
            font-size: 13px;
            color: #6b7280;
            font-weight: 600;
            border-bottom: 2px solid #e5e7eb;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
            color: #374151;
        }

        table tr:hover {
            background: #f9fafb;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge.debutant { background: #dcfce7; color: #16a34a; }
        .badge.intermediaire { background: #fef3c7; color: #d97706; }
        .badge.avance { background: #fee2e2; color: #dc2626; }

        .no-data {
            text-align: center;
            padding: 30px;
            color: #9ca3af;
            font-style: italic;
        }

        .date-badge {
            background: #ede9fe;
            color: #7c3aed;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
        }
    </style>
<body>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>📊 Tableau de Bord - Statistiques</h1>
        <p>Vue d'ensemble complète de la plateforme LMS</p>
    </div>

    <!--  Cards (4) -->
    <div class="kpi-grid">
        <!-- total des courses 1 -->
        <div class="kpi-card">
            <div class="kpi-card-header">
                <div class="kpi-icon blue">📚</div>
                <h3>Total des Cours</h3>
            </div>
            <div class="kpi-number"><?php echo $totalCourses?></div>
        </div>

        <!-- total des users 2 -->
        <div class="kpi-card">
            <div class="kpi-card-header">
                <div class="kpi-icon green">👥</div>
                <h3>Total des Utilisateurs</h3>
            </div>
            <div class="kpi-number"><?php echo $totalUsers?></div>
        </div>

        <!-- total des inscriptions  3 -->
        <div class="kpi-card">
            <div class="kpi-card-header">
                <div class="kpi-icon purple">✅</div>
                <h3>Total des Inscriptions</h3>
            </div>
            <div class="kpi-number"><?php echo $totalEnrollments ?></div>
        </div>

          <!-- Cours le Plus Populaire 4 -->
        <div class="kpi-card">
            <div class="kpi-card-header">
                <div class="kpi-icon orange">🏆</div>
                <h3>Cours le Plus Populaire</h3>
            </div>
            <div class="kpi-text">
                <?php 
                    echo $popularCourse['title'] . " (" . $popularCourse['nombre'] . ")";
                ?>
            </div>
        </div>
    </div>

    <!-- Tables Grid -->
    <div class="tables-grid">
        
        <!-- Inscriptions par cours 5 -->
        <div class="table-section">
            <h2>Inscriptions par Cours</h2>
        
            <table>
                <thead>
                    <tr>
                        <th>Cours</th>
                        <th>Inscriptions</th>
                    </tr>
                </thead>
                <tbody>
                
                    <tr>
                        <td>///////////////////////</td>
                        <td><strong>///////////</strong></td>
                    </tr>
                
                </tbody>
            </table>
        
        </div>


        <!-- Cours ayant plus de 5 sections -->
<div class="table-section">
    <h2>Cours Ayant Plus de 5 Sections</h2>

        <table>
            <thead>
                <tr>
                    <th>Cours</th>
                    <th>Nombre de Sections</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>titre de nomcre sections</td>
                        <td><strong>NNNNNNNNNN</strong></td>
                    </tr>
            </tbody>
        </table>

</div>
        <!--   users inscrits en cette annee -->
        <div class="table-section">
            <h2>Inscriptions de cette Année</h2>
            <table>
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                                    <tr>
                        <td> hamza </td>
                        <td>bvjhvb fdc@gmail.com</td>
                        <td><span class="date-badge">/////////////////////////////////</span></td>
                    </tr>
                </tbody>
            </table>
</div>

        <!--  Cours sans inscription -->
        <div class="table-section">
            <h2>Cours Sans Inscription</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Niveau</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>8</td>
                        <td>///////////////////////</td>
                        <td><span class="badge avance">Avancé</span></td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>/////////////////////</td>
                        <td><span class="badge avance">Avancé</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Dernieres inscriptions -->
        <div class="table-section">
            <h2>Dernières Inscriptions</h2>
            <table>
                <thead>
                    <tr>
                        <th>Étudiant</th>
                        <th>Cours</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>/////////////////</td>
                        <td>Introduction à PHP</td>
                        <td><span class="date-badge">20/12/2024 14:30</span></td>
                    </tr>
                    <tr>
                        <td>///////////////////</td>
                        <td>JavaScript Avancé</td>
                        <td><span class="date-badge">19/12/2024 16:45</span></td>
                    </tr>
                    <tr>
                        <td>/////////////////</td>
                        <td>HTML & CSS</td>
                        <td><span class="date-badge">18/12/2024 10:20</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>


</body>
</html>

<!-- natural join -->
 



