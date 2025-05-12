<template>
  <div class="scene-wrapper">
    <div class="scene-background" :style="backgroundStyle">
      <div class="scene-overlay">
        <div class="scene-content">
          <h1 class="scene-title">{{ scene.title }}</h1>
          <div class="scene-text" v-html="scene.description"></div>
          
          <div class="scene-actions" v-if="scene.choices && scene.choices.length">
            <SceneChoices 
              :choices="scene.choices"
              @choice-selected="handleChoice"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Scene',
  props: {
    sceneId: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      scene: {
        title: '',
        description: '',
        background: '',
        choices: []
      }
    }
  },
  computed: {
    backgroundStyle() {
      return {
        backgroundImage: this.scene.background ? `url(${this.scene.background})` : 'none',
        backgroundSize: 'cover',
        backgroundPosition: 'center'
      }
    }
  },
  methods: {
    async loadScene() {
      try {
        const response = await axios.get(`/api/scenes/${this.sceneId}`)
        this.scene = response.data
      } catch (error) {
        console.error('Erreur lors du chargement de la scène:', error)
      }
    },
    handleChoice(choiceId) {
      this.$emit('scene-change', choiceId)
    }
  },
  created() {
    this.loadScene()
  },
  watch: {
    sceneId: {
      handler(newId) {
        this.loadScene()
      },
      immediate: true
    }
  }
}
</script>

<style scoped>
.scene-wrapper {
  position: relative;
  width: 100%;
  min-height: 100vh;
  overflow: hidden;
}

.scene-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transition: background-image 0.5s ease;
}

.scene-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  align-items: center;
  justify-content: center;
}

.scene-content {
  max-width: 800px;
  width: 90%;
  padding: 2rem;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border-radius: 1rem;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.scene-title {
  font-size: 2.5rem;
  color: #e94560;
  margin-bottom: 1.5rem;
  text-align: center;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.scene-text {
  font-size: 1.2rem;
  line-height: 1.6;
  color: #fff;
  margin-bottom: 2rem;
}

.scene-actions {
  margin-top: 2rem;
}

@media (max-width: 768px) {
  .scene-content {
    padding: 1.5rem;
  }
  
  .scene-title {
    font-size: 2rem;
  }
  
  .scene-text {
    font-size: 1.1rem;
  }
}
</style> 