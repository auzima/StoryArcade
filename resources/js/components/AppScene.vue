<template>
  <div class="scene-container">
    <div class="scene-content">
      <div class="scene-header">
        <h1 class="scene-title">{{ scene.title }}</h1>
      </div>
      
      <div class="scene-body">
        <div class="scene-description" v-html="scene.description"></div>
        
        <div class="scene-choices" v-if="scene.choices && scene.choices.length">
          <SceneChoices 
            :choices="scene.choices"
            @choice-selected="handleChoice"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SceneChoices from './SceneChoices.vue'

export default {
  name: 'AppScene',
  components: {
    SceneChoices
  },
  data() {
    return {
      scene: {
        title: '',
        description: '',
        choices: []
      }
    }
  },
  methods: {
    async fetchScene(sceneId) {
      try {
        const response = await axios.get(`/api/scenes/${sceneId}`)
        this.scene = response.data
      } catch (error) {
        console.error('Erreur lors du chargement de la scène:', error)
      }
    },
    handleChoice(choiceId) {
      // Navigation vers la prochaine scène
      this.$router.push(`/play/scene/${choiceId}`)
    }
  },
  created() {
    const sceneId = this.$route.params.id
    this.fetchScene(sceneId)
  }
}
</script>

<style scoped>
.scene-container {
  min-height: 100vh;
  background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
  color: #fff;
  padding: 2rem;
}

.scene-content {
  max-width: 800px;
  margin: 0 auto;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border-radius: 1rem;
  padding: 2rem;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.scene-header {
  margin-bottom: 2rem;
  text-align: center;
}

.scene-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #e94560;
  margin: 0;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.scene-body {
  font-size: 1.2rem;
  line-height: 1.6;
}

.scene-description {
  margin-bottom: 2rem;
  padding: 1rem;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 0.5rem;
}

.scene-choices {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

@media (max-width: 768px) {
  .scene-container {
    padding: 1rem;
  }
  
  .scene-content {
    padding: 1.5rem;
  }
  
  .scene-title {
    font-size: 2rem;
  }
  
  .scene-body {
    font-size: 1.1rem;
  }
}
</style> 