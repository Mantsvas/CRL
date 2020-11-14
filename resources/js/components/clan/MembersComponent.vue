<template>
    <table class="table table-hover table-striped">
        <thead>
            <tr class="bg-dark">
                <th>#</th>
                <th :class="sortBy === 'name' ? 'active' : ' '" @click="sortByValue('name')">Name</th>
                <th :class="['text-right', sortBy === 'trophies' ? 'active' : ' ']" @click="sortByValue('trophies')">Trophies</th>
                <th :class="['text-right', sortBy === 'bestTrophies' ? 'active' : ' ']" @click="sortByValue('bestTrophies')">PB</th>
                <th :class="['text-left', sortBy === 'tag' ? 'active' : ' ']" @click="sortByValue('tag')">Tag</th>
                <th :class="['text-right', sortBy === 'level' ? 'active' : ' ']" @click="sortByValue('level')">Level</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(member, index) in sortedMembers" :key="member.tag">
                <td>{{ index + 1 }}</td>
                <td >{{ member.name }}</td>
                <td class="text-right">{{ member.trophies }} <img class="clanBadge" :src="'/storage/images/arena_badges/arena_' + member.arena.id + '.png'"  :title="member.arena.name"/></td>
                <td class="text-right">{{ member.bestTrophies }}</td>
                <td class="text-left">#{{ member.tag }}</td>
                <td class="text-right">{{ member.level }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ['members'],
    data() {
        return {
            'sortBy': 'bestTrophies',
            'sortDirection': 'desc',
        }
    },
    computed: {
        sortedMembers: function() {
            return _.orderBy(this.members, this.sortBy, this.sortDirection)
        }
    },
    methods: {
        sortByValue(key) {
            if (this.sortBy === key) {
                this.sortDirection = this.sortDirection === 'desc' ? 'asc' : 'desc';
            } else {
                this.sortBy = key;
                this.sortDirection = 'desc'
            }
        }
    }
}
</script>

<style scoped>
    th {
        cursor: pointer;
    }

    th:hover {
        background-color: lightgrey;
    }
</style>