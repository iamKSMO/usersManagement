<?php
require_once __DIR__ . '/../../../config/bd.php';
require_once __DIR__.'/../../models/User.php';
require_once __DIR__.'/../../controllers/AuthController.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function showTab(tabId) {
            document.getElementById('profileTab').classList.add('hidden');
            document.getElementById('historyTab').classList.add('hidden');
            document.getElementById(tabId).classList.remove('hidden');
        }
    </script>
</head>
<body class="bg-[#f6f6f9] flex items-center justify-center min-h-screen p-6">

    <div class="bg-white shadow-lg rounded-2xl w-full max-w-3xl p-8 relative">

        <!-- Bouton Déconnexion -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-[#7380eC]">Mon Compte</h2>
            <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-600 transition">
                Déconnexion
            </a>
        </div>

        <!-- Barre de navigation -->
        <div class="flex justify-center border-b pb-3 mb-6 space-x-6">
            <button onclick="showTab('profileTab')" class="text-[#7380eC] font-semibold py-2 px-4 rounded-lg hover:bg-[#f6f6f9] transition">Mon Profil</button>
            <button onclick="showTab('historyTab')" class="text-[#7380eC] font-semibold py-2 px-4 rounded-lg hover:bg-[#f6f6f9] transition">Historique</button>
        </div>

        <!-- Onglet Mon Profil -->
        <div id="profileTab" class="space-y-6">
            
            <!-- Informations Utilisateur -->
            <div class="bg-[#f6f6f9] p-4 rounded-lg">
                <h3 class="text-xl font-semibold text-[#7380eC] mb-3">Informations personnelles</h3>
                <div class="space-y-2">
                    <p class="text-gray-700"><strong>Nom complet :</strong>  <?= $_SESSION['user']['username']; ?></p>
                    <p class="text-gray-700"><strong>Email :</strong>  <?= $_SESSION['user']['email'] ?></p>
                    <p class="text-gray-700"><strong>Rôle :</strong> <?= $_SESSION['user']['role_name'] ?></p>
                </div>
            </div>

            <!-- Formulaire de Modification -->
            <div class="bg-[#f6f6f9] p-4 rounded-lg">
                <h3 class="text-xl font-semibold text-[#7380eC] mb-3">Modifier mes informations</h3>
                <form class="space-y-4" method="post" action="updateProfile.php">
                    <div>
                        <label class="text-gray-600">Nom complet</label>
                        <input type="text" name="usernameU" value="<?= $_SESSION['user']['username']; ?>" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#7380eC] focus:outline-none">
                    </div>

                    <div>
                        <label class="text-gray-600">Adresse e-mail</label>
                        <input type="email" name="emailU" value="<?= $_SESSION['user']['email']; ?>" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#7380eC] focus:outline-none">
                    </div>

                    <button class="w-full mt-4 bg-[#7380eC] text-white py-2 rounded-lg text-lg font-semibold hover:bg-[#5e6fd6] transition duration-300">
                        Enregistrer les modifications
                    </button>
                </form>
            </div>
        </div>

        <!--  Onglet Historique de connexion -->
        <div id="historyTab" class="hidden space-y-6">
            <h3 class="text-xl font-semibold text-[#7380eC]">Historique des connexions</h3>

            <div class="overflow-x-auto bg-[#f6f6f9] p-4 rounded-lg">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
                    <thead>
                        <tr class="bg-[#7380eC] text-white">
                            <th class="py-2 px-4 border">Date</th>
                            <th class="py-2 px-4 border">Heure</th>
                            <th class="py-2 px-4 border">Adresse IP</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                <?php if (!empty($loginHistory)): ?>
                    <?php foreach ($loginHistory as $history): ?>
                        <tr class="border">
                            <td class="py-2 px-4 text-center"><?php echo date('d/m/Y', strtotime($history['login_time'])); ?></td>
                            <td class="py-2 px-4 text-center"><?php echo date('H:i', strtotime($history['login_time'])); ?></td>
                            <td class="py-2 px-4 text-center"><?php echo $history['ip_address'] ?? 'Non spécifié'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="border">
                        <td colspan="3" class="py-2 px-4 text-center">Aucune connexion trouvée.</td>
                    </tr>
                <?php endif; ?>
                        <!-- <tr class="border">
                            <td class="py-2 px-4 text-center">12/03/2024</td>
                            <td class="py-2 px-4 text-center">14h30</td>
                            <td class="py-2 px-4 text-center">192.168.1.1</td>
                        </tr>
                        <tr class="border bg-gray-100">
                            <td class="py-2 px-4 text-center">11/03/2024</td>
                            <td class="py-2 px-4 text-center">18h10</td>
                            <td class="py-2 px-4 text-center">192.168.1.2</td>
                        </tr>
                        <tr class="border">
                            <td class="py-2 px-4 text-center">10/03/2024</td>
                            <td class="py-2 px-4 text-center">09h45</td>
                            <td class="py-2 px-4 text-center">192.168.1.3</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>
