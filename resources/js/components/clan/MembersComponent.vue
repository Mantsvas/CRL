<template>
<div>
    <div>
        <div :class="['card-nav-item ', selectedContent === 'trophies' ? 'active' : ' ']" @click="changeContent('trophies')">Trophies</div>
        <div :class="['card-nav-item ', selectedContent === 'cards' ? 'active' : ' ']" @click="changeContent('cards')">Cards</div>
    </div>
    <table v-if="selectedContent === 'trophies'" class="table table-hover table-striped">
        <thead>
            <tr class="bg-dark">
                <th :class="sortBy === 'name' ? 'active' : ' '" @click="sortByValue('name')">Name</th>
                <th :class="['text-right', sortBy === 'trophies' ? 'active' : ' ']" @click="sortByValue('trophies')">Trophies</th>
                <th :class="['text-right', sortBy === 'bestTrophies' ? 'active' : ' ']" @click="sortByValue('bestTrophies')">PB</th>
                <th :class="['text-left d-none d-sm-table-cell', sortBy === 'tag' ? 'active' : ' ']" @click="sortByValue('tag')">Tag</th>
                <th :class="['text-right d-none d-sm-table-cell', sortBy === 'level' ? 'active' : ' ']" @click="sortByValue('level')">Level</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(member, index) in sortedMembers" :key="member.tag">
                <td>{{ index + 1 }}. {{ member.name }}</td>
                <td class="text-right">{{ member.trophies }} <img class="clanBadge" :src="'/storage/images/arena_badges/arena_' + member.arena.id + '.png'"  :title="member.arena.name"/></td>
                <td class="text-right">{{ member.bestTrophies }}</td>
                <td class="text-left d-none d-sm-table-cell">#{{ member.tag }}</td>
                <td class="text-right d-none d-sm-table-cell">{{ member.level }}</td>
            </tr>
        </tbody>
    </table>

    <table v-if="selectedContent === 'cards'" class="table table-hover table-striped">
        <thead>
            <tr class="bg-dark">
                <th :class="sortBy === 'name' ? 'active' : ' '" @click="sortByValue('name')">Name</th>
                <th :class="['text-right', sortBy === 'goldProgress' ? 'active' : ' ']" @click="sortByValue('goldProgress')">Gold</th>
                <th :class="['text-right', sortBy === 'legendaryCollected' ? 'active' : ' ']" @click="sortByValue('legendaryCollected')">Legendary</th>
                <th :class="['text-right', sortBy === 'epicCollected' ? 'active' : ' ']" @click="sortByValue('epicCollected')">Epic</th>
                <th :class="['text-right', sortBy === 'rareCollected' ? 'active' : ' ']" @click="sortByValue('rareCollected')">Rare</th>
                <th :class="['text-right', sortBy === 'commonCollected' ? 'active' : ' ']" @click="sortByValue('commonCollected')">Common</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(member, index) in sortedMembers" :key="member.tag">
                <td>{{ index + 1 }}. {{ member.name }}</td>
                <td class="text-right">{{ member.goldProgress }}% <icon icon="gold" /></td>
                <td class="text-right">{{ member.legendaryCollected }}% <icon icon="legendary" /></td>
                <td class="text-right">{{ member.epicCollected }}% <icon icon="epic" /></td>
                <td class="text-right">{{ member.rareCollected }}% <icon icon="rare" /></td>
                <td class="text-right">{{ member.commonCollected }}% <icon icon="common" /></td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
export default {
    props: ['members'],
    data() {
        return {
            'sortBy': 'bestTrophies',
            'sortDirection': 'desc',
            'selectedContent': 'trophies',
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
        },
        changeContent(content) {
            this.selectedContent = content;
            if (content == 'trophies') {
                this.sortBy = 'trophies';
            } else if (content == 'cards') {
                this.sortBy = 'goldProgress';
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

    .card-nav-item {
        display: inline-block;
        padding: 0.5em 2em;
        cursor: pointer;
    }
</style>