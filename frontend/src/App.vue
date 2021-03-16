<template>
  <div id="app">

    <div class="container">
        <nav class="nav flex align--center ">
            <router-link to="/" class="flex align--center">Home</router-link>
            <router-link to="/shop" class="flex align--center">Shop</router-link>
        </nav>
    </div>

    <router-view/>
  </div>
</template>

<style>

    .nav {
        background: var(--light-gray)
    }

    .nav > a {
        height: 40px;
        padding: 0 20px;
    }
</style>
