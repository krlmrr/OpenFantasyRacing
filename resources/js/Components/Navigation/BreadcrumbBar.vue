<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <nav class="flex my-2 mx-4 justify-center" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-4">
      <li>
        <div>
          <Link href="/" class="text-gray-400 hover:text-gray-500">
            <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
            <span class="sr-only">Home</span>
          </Link>
        </div>
      </li>
      <li v-for="page in pages" :key="page.name">
        <div class="flex items-center">
          <ChevronRightIcon class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" />
          <Link :href="page.href" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" :aria-current="page.current ? 'page' : undefined">
            {{ page.name }}
          </Link>
        </div>
      </li>
    </ol>
  </nav>
</template>

<script setup>
  import { ChevronRightIcon, HomeIcon } from '@heroicons/vue/solid'

  defineProps({
    pages: Array
  })

</script>