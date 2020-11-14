<template>
    <img class="clanBadge" :src="'/images/icons/' + icon + '.png'" />
</template>

<script>
export default {
    props: ['icon'],
}
</script>