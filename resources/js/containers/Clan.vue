<template>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card">
                <div class="card-header clan-header">
                    <div class="pull-left">
                        <span class="text-left pr-4">    
                            <img v-if="clan.badgeId" class="clanBadge" :src="'/storage/images/clan_badges/clan_badge_' + clan.badgeId + '.png'" /> 
                            {{ clan.name }}
                        </span>
                        <span class="text-left">    
                            <icon icon="members" /> 
                            {{ clan.members }}
                        </span>
                    </div>
                    <div class="pull-right">
                        <div class="text-right mb-2">
                            {{ clan.clanScore }} 
                            <icon icon="trophy" />
                        </div>
                        <div class="text-right">
                            {{ clan.clanWarTrophies }} 
                            <icon icon="war-trophy" />
                        </div>
                    </div>
                </div>
                <div class="border-bottom">
                    <div v-for="navItem in navItems" :class="['card-nav-item', navItem.key === content ? 'active' : ' ']" :key="navItem.key" @click="changeContent(navItem.key)">{{ navItem.text }}</div>
                </div>
                
                <div class="card-body no-padding">
                    <template v-if="content === 'info'">
                        <clan-info-component></clan-info-component>
                    </template>

                    <template v-if="content === 'riverRace'">
                        <clan-river-race-component :race="clan.currentRiverRace"></clan-river-race-component>
                    </template>

                    <template v-if="content === 'members'">
                        <clan-members-component :members="clan.players"></clan-members-component>
                    </template>

                    <template v-if="content === 'riverRaceLog'">
                        <clan-river-race-log-component></clan-river-race-log-component>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tag'],
        data() {
            return {
                'clan': [],
                'navItems': [
                    // { 'key': 'info', 'text': 'Info' },
                    { 'key': 'members', 'text': 'Members' },
                    { 'key': 'riverRace', 'text': 'River Race' },
                    // { 'key': 'cardinfo', 'text': 'Cards' },
                ],
                'content' : 'members',
            };
        },
        mounted() {
            this.getClan();
        },
        methods: {
            getClan() {
                axios.get('/api/clan/' + this.tag).then((res) => {
                    this.clan = res.data.data;
                });
            },
            changeContent(content) {
                this.content = content;
            }
        }
    }
</script>

<style>
    .clan-header {
        font-size: 1.1em;
        font-weight: 700;
        background-color: blue;
        color: gold;
    }

    .card-nav-item {
        display: inline-block;
        padding: 0.5em 2em;
        cursor: pointer;
    }

    .card-nav-item:hover {
        background-color: lightblue;
        color: blue;
        font-weight: 700;
    }
</style>
