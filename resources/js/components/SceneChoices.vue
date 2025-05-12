<template>
  <div class="choices-container">
    <div 
      v-for="choice in choices" 
      :key="choice.id"
      class="choice-item"
      @click="selectChoice(choice.id)"
    >
      <div class="choice-content">
        <h3 class="choice-title">{{ choice.title }}</h3>
        <p class="choice-description">{{ choice.description }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SceneChoices',
  props: {
    choices: {
      type: Array,
      required: true
    }
  },
  methods: {
    selectChoice(choiceId) {
      this.$emit('choice-selected', choiceId)
    }
  }
}
</script>

<style scoped>
.choices-container {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.choice-item {
  background: rgba(255, 255, 255, 0.1);
  border: 2px solid rgba(255, 255, 255, 0.2);
  border-radius: 0.8rem;
  padding: 1.5rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.choice-item:hover {
  background: rgba(255, 255, 255, 0.15);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  border-color: #e94560;
}

.choice-content {
  color: #fff;
}

.choice-title {
  font-size: 1.3rem;
  font-weight: 600;
  margin: 0 0 0.5rem 0;
  color: #e94560;
}

.choice-description {
  font-size: 1.1rem;
  margin: 0;
  opacity: 0.9;
}

@media (max-width: 768px) {
  .choice-item {
    padding: 1.2rem;
  }
  
  .choice-title {
    font-size: 1.2rem;
  }
  
  .choice-description {
    font-size: 1rem;
  }
}
</style>