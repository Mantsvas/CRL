<template>
    <table class="table table-hover table-striped">
        <thead>
            <tr class="bg-dark">
                <th>#</th>
                <th>Name</th>
                <th class="text-right">Repair <icon icon="cw-repair" /></th>
                <th class="text-right">Fame <icon icon="cw-fame" /></th>
                <th class="text-right">Trophy <icon icon="war-trophy" /></th>
            </tr>
        </thead>
        <tbody>

            <template v-for="(clan, index) in race.clans">
                <tr :key="index">
                    <td>{{ Number(index) + 1 }}</td>
                    <td @click="selectClan(clan)" style="cursor:pointer;">
                        <div>{{ clan.name }}</div>
                        <div class="small-text">{{ clan.finishTime }}</div>
                    </td>
                    <td class="text-right">{{ clan.repairPoints }} <icon icon="cw-repair" /></td>
                    <td class="text-right">{{ clan.fame }} <icon icon="cw-fame" /></td>
                    <td class="text-right">{{ clan.clanScore }} <icon icon="war-trophy" /></td>
                </tr>
            </template>

            <template v-if="selectedClan.tag === selectedClanTag">
                <tr class="bg-dark">
                    <th colspan="2">Participants</th>
                    <th class="text-right"><icon icon="cw-repair" /></th>
                    <th class="text-right"><icon icon="cw-fame" /></th>
                    <th class="text-right"><icon icon="cw-repair" /> + <icon icon="cw-fame" /></th>
                </tr>
                <tr :key="participant.tag" v-for="(participant, i) in selectedClan.participants.slice().reverse()">
                    <td>{{ Number(i) + 1 }}</td>
                    <td>
                        <div>{{ participant.name }}</div>
                        <div class="small-text">{{ participant.finishTime }}</div>
                    </td>
                    <td class="text-right">{{ participant.repairPoints }} <icon icon="cw-repair" /></td>
                    <td class="text-right">{{ participant.fame }} <icon icon="cw-fame" /></td>
                    <td class="text-right">{{ participant.repairPoints + participant.fame }} <icon icon="cw-repair" /> + <icon icon="cw-fame" /></td>
                </tr>
            </template>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ["race"],
    data() {
        return {
            'selectedClanTag': '',
            'selectedClan': [],
        }
    },
    methods: {
        selectClan(clan) {
            this.selectedClanTag = clan.tag;
            this.selectedClan = clan;
        }
    }
}
</script>

<style scoped>
    .small-text {
        font-size: 0.6em;
    }

</style>