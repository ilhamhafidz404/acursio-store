<template>
  <Carousel v-bind="settings" :breakpoints="breakpoints" class="grid">
    <Slide v-for="account in AccountStores.data" :key="account.id">
      <div class="carousel__item w-[95%] text-left">
        <Card :key="account.id" :account="account" />
      </div>
    </Slide>

    <template #addons>
      <PaginationCarausel />
    </template>
  </Carousel>
</template>

<script>
// packages
import {
  Carousel,
  Navigation,
  Slide,
  Pagination as PaginationCarausel,
} from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';

// components
import Card from "../../components/card/index.vue";

export default {
  props: { AccountStores: Array },
  components: {
    Carousel,
    Slide,
    Navigation,
    PaginationCarausel,
    Card
  },
  data: () => ({
    settings: {
      itemsToShow: 2,
      snapAlign: 'center',
      autoplay: 3000,
      wrapAround: true,
    },
    breakpoints: {
      100: {
        itemsToShow: 1.8,
        snapAlign: 'center',
      },
      700: {
        itemsToShow: 3.5,
        snapAlign: 'center',
      },
      1024: {
        itemsToShow: 4.5,
        snapAlign: 'start',
      },
    },
  }),
};
</script>

<style>
.carousel__pagination-button::after {
  background-color: #2a323c !important;
}
.carousel__pagination-button--active::after {
  background-color: #7480ff !important;
}
</style>
