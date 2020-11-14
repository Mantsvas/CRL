<template>
    <div>
        <table class="table table-hover no-padding">
            <thead>
                <tr>
                    <th>#</th>
                    <th :class="col.class" v-for="(col, index) in columns" :key="index" @click="sortByValue(col.key)">{{ col.text }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(member, index) in sortedMembers" :key="member.tag">
                    <td>{{ index + 1 }}</td>
                    <td :class="col.class" v-for="(col, index) in columns" :key="index">{{col.prefix}}{{ member[col.key] }}</td>
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
            'columns': [
                {'key': 'name', 'text': 'Name'},
                {'key': 'bestTrophies', 'text': 'PB'},
                {'key': 'trophies', 'text': 'Trophies'},
                {'key': 'tag', 'text': 'Tag', 'prefix': '#', 'class': 'd-none d-md-table-cell'},
                {'key': 'level', 'text': 'Level', 'class': 'd-none d-md-table-cell'},
            ],
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