<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Laravel Machine Test</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <Dropdown align="right" width="48">
            <template #trigger>
              <span class="inline-flex rounded-md">
                <button
                  type="button"
                  class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                >
                  {{ $page.props.auth.user.name }}
                  <svg
                    class="ms-2 -me-0.5 h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"
                    />
                  </svg>
                </button>
              </span>
            </template>

            <template #content>
              <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
              <DropdownLink :href="route('logout')" method="post" as="button">
                Log Out
              </DropdownLink>
            </template>
          </Dropdown>
      </div>
    </nav>
    <div class="sidebar">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a :class="['nav-link', props.main == 1 ? 'active' : '']" href="/categories">Category</a>
        </li>
        <li class="nav-item">
          <a :class="['nav-link', props.main == 2 ? 'active' : '']" href="/products">Products</a>
        </li>
        <li class="nav-item">
          <a :class="['nav-link', props.main == 3 ? 'active' : '']" href="/sales">Sales</a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const props = defineProps(['main'])
</script>

<style scope>
.sidebar {
  width: 250px;
  height: 100vh;
  background-color: #f0f0f0;
  border-right: 1px solid #ddd;
  padding-top: 20px;
  position: fixed;
}

.sub-menu {
  padding-left: 20px;
}

.nav-link {
  color: #333;
}

.nav-link:hover {
  background-color: rgb(204, 201, 201);
  border-radius: 10px;
  transition: 0.3s;
}

.sub-menu .nav-item:hover {
  background-color: rgb(204, 201, 201);
  border-radius: 5px;
  border: 1px solid  rgb(204, 201, 201);;
  transition: 0.3s;
}
.content {
    margin-left: 200px; 
    margin-top: 56px;
  }

.active {
  background-color: rgb(210, 208, 208);
  border-radius: 10px;
}
</style>