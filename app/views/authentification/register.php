<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f6f6f9] flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-2xl overflow-hidden max-w-4xl w-full flex flex-col md:flex-row">
        
        <!-- Section de gauche -->
        <div class="hidden md:flex flex-col justify-center items-center bg-[#7380eC] text-white w-1/2 p-8">
            <h2 class="text-2xl font-bold mb-4">Rejoignez-nous dès aujourd'hui !</h2>
            <p class="text-lg text-center">Inscrivez-vous pour accéder à votre espace sécurisé et gérer votre compte facilement.</p>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-semibold text-[#7380eC] text-center mb-6">Créer un compte</h2>

            <form method="post" action="index.php?action=register" class="space-y-4">
                
                <!-- Champ Nom -->
                <div>
                    <label class="block text-gray-700">Nom complet</label>
                    <input type="text" name="username" required placeholder="Votre nom" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#7380eC] focus:outline-none">
                </div>

                <!-- Champ Email -->
                <div>
                    <label class="block text-gray-700">Adresse e-mail</label>
                    <input type="email" name="email" required placeholder="email@example.com" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#7380eC] focus:outline-none">
                </div>

                <!-- Champ Mot de passe -->
                <div>
                    <label class="block text-gray-700">Mot de passe</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#7380eC] focus:outline-none">
                </div>

                <!-- Sélecteur Rôle -->
                <div>
                    <label class="block text-gray-700">Rôle</label>
                    <select name="role" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#7380eC] focus:outline-none">
                        <option value="client">Client</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>


                <!-- Accepter les conditions -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" required class="mr-2">
                        <span class="text-gray-700">J'accepte les <a href="#" class="text-[#7380eC] hover:underline">conditions d'utilisation</a></span>
                    </label>
                </div>

                <!-- Bouton d'inscription -->
                <button type="submit" class="w-full bg-[#7380eC] text-white py-2 rounded-lg text-lg font-semibold hover:bg-[#5e6fd6] transition duration-300">S'inscrire</button>

                <!-- Lien vers connexion -->
                <p class="text-center text-gray-700">
                    Vous avez déjà un compte ? 
                    <a href="/login" class="text-[#7380eC] hover:underline">Connexion</a>
                </p>

            </form>
        </div>
    </div>

</body>
</html>
