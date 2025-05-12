<template>
    <div class="min-h-screen bg-black py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-gray-900 shadow-xl rounded-lg p-8 text-center">
                <h1 class="text-4xl font-bold text-white mb-6">Bienvenue sur Sauvage Lune</h1>
                
                <div class="prose prose-lg mb-8 mx-auto">
                    <p class="text-gray-300">
                        Découvrez l'univers mystérieux de Sauvage Lune, un jeu immersif où chaque décision compte.
                        Plongez dans une aventure unique où vous devrez faire face à des défis passionnants
                        et découvrir des secrets enfouis depuis des siècles.
                    </p>
                </div>

                <div class="text-center">
                    <router-link 
                        to="/games" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-pink-500 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500"
                    >
                        Découvrir les jeux
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'HomePage'
}
</script>

<style scoped>
.home-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #000;
    color: #fff;
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.hero-section {
    max-width: 800px;
    text-align: center;
    z-index: 1;
}

.title {
    font-size: 4rem;
    margin-bottom: 2rem;
    color: #fff;
    font-weight: bold;
    text-shadow: 0 0 10px rgba(255, 105, 180, 0.3);
}

.description {
    font-size: 1.2rem;
    line-height: 1.8;
    margin-bottom: 3rem;
    color: #e0e0e0;
}

.features {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-bottom: 3rem;
}

.feature {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.feature-icon {
    font-size: 2rem;
}

.feature-text {
    font-size: 1rem;
    color: #e0e0e0;
}

.discover-button {
    display: inline-block;
    padding: 1.2rem 2.5rem;
    background-color: #ff69b4;
    color: white;
    text-decoration: none;
    border-radius: 30px;
    font-size: 1.2rem;
    font-weight: bold;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.discover-button:hover {
    background-color: #ff1493;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 105, 180, 0.3);
}

/* Animations */
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

.animate-fade-in-delay-3 {
    opacity: 0;
    animation: fadeIn 1s ease forwards 0.9s;
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

/* Responsive Design */
@media (max-width: 768px) {
    .title {
        font-size: 3rem;
    }

    .features {
        flex-direction: column;
        gap: 1.5rem;
    }

    .description {
        font-size: 1.1rem;
    }
}
</style>