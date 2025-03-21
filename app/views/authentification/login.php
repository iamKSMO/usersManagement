<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f6f6f9] flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-2xl overflow-hidden max-w-2xl w-full flex flex-col md:flex-row">
        
        <!-- Section de gauche -->
        <div class="hidden md:flex flex-col justify-center items-center bg-[#7380eC] text-white w-1/2 p-8">
            <h2 class="text-2xl font-bold mb-4">Bon retour parmi nous !</h2>
            <p class="text-lg text-center">Connectez-vous pour accéder à votre compte et gérer vos informations.</p>
        </div>

        <!-- Formulaire de connexion -->
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-semibold text-[#7380eC] text-center mb-6">Connexion</h2>

            <form method="post" action="/usersManagement/index.php?action=login" class="space-y-4">
                
                <!-- Champ Email -->
                <div>
                    <label class="block text-gray-700">Adresse e-mail</label>
                    <input type="email" name="email" required placeholder="email@exemple.com" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#7380eC] focus:outline-none">
                </div>

                <!-- Champ Mot de passe -->
                <div>
                    <label class="block text-gray-700">Mot de passe</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#7380eC] focus:outline-none">
                </div>

                <!-- Se souvenir de moi + Mot de passe oublié -->
                <div class="flex justify-between items-center">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        <span class="text-gray-700">Rapelle moi</span>
                    </label>
                    <a href="/forgot-password" class="text-[#7380eC] hover:underline">Mot de passe oublié ?</a>
                </div>

                <!-- Bouton de connexion -->
                <button type="submit" class="w-full bg-[#7380eC] text-white py-2 rounded-lg text-lg font-semibold hover:bg-[#5e6fd6] transition duration-300">Se connecter</button>

                <!-- Lien vers inscription -->
                <p class="text-center text-gray-700">
                    Vous n'avez pas de compte ? 
                    <a href="/usersManagement/app/views/authentification/register.php" class="text-[#7380eC] hover:underline">S'inscrire</a>
                </p>

            </form>
        </div>
    </div>

</body>
</html>
