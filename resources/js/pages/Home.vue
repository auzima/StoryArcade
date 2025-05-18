<template>
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-gray-900 shadow-xl rounded-lg p-8 text-center">
                <h1 class="text-4xl font-bold text-white mb-6 animate-fade-in">
                    Bienvenue sur Sauvage Lune
                </h1>
                
                <div class="prose prose-lg mb-8 mx-auto animate-fade-in-delay">
                    <p class="text-gray-300">
                        Découvrez l'univers mystérieux de Sauvage Lune, un jeu immersif où chaque décision compte.
                        Plongez dans une aventure unique où vous devrez faire face à des défis passionnants
                        et découvrir des secrets enfouis depuis des siècles.
                    </p>
                </div>

                <div class="text-center animate-fade-in-delay-2">
                    <router-link to="/play" 
                               class="inline-flex items-center px-6 py-3 border border-transparent
                                      text-base font-medium rounded-md text-white bg-pink-500
                                      hover:bg-pink-600 focus:outline-none focus:ring-2
                                      focus:ring-offset-2 focus:ring-pink-500">
                        Découvrir les jeux
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Home'
}
</script>

<style scoped>
.animate-fade-in {
    opacity: 0;
    animation: fadeIn 1s ease forwards;
}

.animate-fade-in-delay {
    opacity: 0;
    animation: fadeIn 1s ease forwards 0.3s;
}

.animate-fade-in-delay-2 {
    opacity: 0;
    animation: fadeIn 1s ease forwards 0.6s;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style> 