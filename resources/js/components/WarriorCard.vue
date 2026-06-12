<template>
    <div class="card-wrapper">
        <div class="card-inner">

            <!-- FRENTE -->
            <div class="card-face card-front" :style="{ '--clan-color': warrior.clan?.color ?? '#b59a4f' }">
                <div class="card-border">
                    <div class="card-content">
                        <div class="card-header">
                            <img :src="'/images/logo-gladius.png'" alt="Gladius" class="card-logo" />
                        </div>

                        <div class="card-photo-wrap">
                            <img :src="warrior.photo" :alt="warrior.name" class="card-photo" />
                            <div class="card-photo-shadow"></div>
                            <div class="card-name-banner">
                                <span>{{ warrior.name.toUpperCase() }}</span>
                            </div>
                        </div>

                        <div class="card-stats">
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <img v-if="warrior.xp_logo" :src="warrior.xp_logo" class="w-8 h-8 object-contain" />
                                    <div v-else class="stat-level-badge">
                                        <span class="stat-level-num">{{ Math.floor(warrior.xp / 100) }}</span>
                                    </div>
                                </div>
                                <div class="stat-label">NÍVEL</div>
                                <div class="stat-value">LV {{ Math.floor(warrior.xp / 100) }}</div>
                            </div>

                            <div class="stat-divider"></div>

                            <div class="stat-item">
                                <div class="stat-icon">
                                    <img v-if="warrior.clan?.logo" :src="warrior.clan.logo" class="w-8 h-8 object-contain" />
                                </div>
                                <div class="stat-label">CLÃ:</div>
                                <div class="stat-value">{{ warrior.clan?.name ?? '—' }}</div>
                            </div>

                            <div class="stat-divider"></div>

                            <div class="stat-item">
                                <div class="stat-icon">
                                    <img v-if="warrior.hp_logo" :src="warrior.hp_logo" class="w-8 h-8 object-contain" />
                                    <span v-else class="text-red-400 font-black text-xs">HP</span>
                                </div>
                                <div class="stat-label">VIDA:</div>
                                <div class="stat-value">{{ warrior.hp }}</div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <span class="rarity" :class="{ holographic: warrior.is_leader }">
                                RARIDADE: {{ warrior.is_leader ? 'HOLOGRÁFICO' : 'COMUM' }}
                            </span>
                            <span class="copyright">© 2024 GLADIUS SWORDPLAY TCG</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VERSO -->
            <div class="card-face card-back" :style="{ '--clan-color': warrior.clan?.color ?? '#b59a4f' }">
                <div class="card-border back-content">
                    <div class="back-logo">
                        <span class="text-3xl font-black text-amber-400" style="font-family: serif;">G</span>
                    </div>

                    <h3 class="back-name">{{ warrior.name }}</h3>

                    <div v-if="warrior.clan" class="back-clan" :style="{ borderColor: warrior.clan.color }">
                        <img :src="warrior.clan.logo" class="w-8 h-8 object-contain" />
                        <span :style="{ color: warrior.clan.color }">{{ warrior.clan.name }}</span>
                    </div>

                    <div class="back-stats">
                        <div class="back-stat">
                            <div class="flex items-center gap-2 mb-1">
                                <img v-if="warrior.xp_logo" :src="warrior.xp_logo" class="w-7 h-7 object-contain" />
                                <span class="back-stat-label text-amber-300">Experiência</span>
                            </div>
                            <div class="back-stat-bar">
                                <div class="back-stat-fill bg-amber-500" :style="{ width: Math.min(warrior.xp / 30, 100) + '%' }"></div>
                            </div>
                            <span class="back-stat-num text-amber-400">{{ warrior.xp }} XP</span>
                        </div>

                        <div class="back-stat">
                            <div class="flex items-center gap-2 mb-1">
                                <img v-if="warrior.hp_logo" :src="warrior.hp_logo" class="w-7 h-7 object-contain" />
                                <span class="back-stat-label text-red-300">Pontos de Vida</span>
                            </div>
                            <div class="back-stat-bar">
                                <div class="back-stat-fill bg-red-500" :style="{ width: Math.min(warrior.hp / 20, 100) + '%' }"></div>
                            </div>
                            <span class="back-stat-num text-red-400">{{ warrior.hp }} HP</span>
                        </div>
                    </div>

                    <div v-if="warrior.is_leader" class="leader-badge">
                        <img v-if="warrior.leader_logo" :src="warrior.leader_logo" class="w-8 h-8 object-contain" />
                        <span>Líder do Clã</span>
                    </div>

                    <div class="back-footer">© 2024 GLADIUS SWORDPLAY TCG</div>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
defineProps({
    warrior: {
        type: Object,
        required: true,
    },
});
</script>

<style scoped>
.card-wrapper {
    aspect-ratio: 9 / 16;
    perspective: 1000px;
}

.card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    transform-style: preserve-3d;
}

.card-wrapper:hover .card-inner {
    transform: rotateY(180deg);
}

.card-face {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 16px;
    overflow: hidden;
}

.card-back {
    transform: rotateY(180deg);
}

.card-border {
    width: 100%;
    height: 100%;
    padding: 1.2rem;
    position: relative;
}

.card-front .card-border{
    background: url('/images/cards/front-background.jpg') center/cover no-repeat;
}

.card-back .card-border {
    background: url('/images/cards/back-background.jpg') center/cover no-repeat;
}

.card-content {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: inset 0 2px 8px rgba(0,0,0,0.6), inset 0 -2px 8px rgba(0,0,0,0.6);
    border: 2px solid #000000;
}

.card-header {
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 6px 8px 4px;
    background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.6) 30%, transparent 100%);
    z-index: 10;
    padding-bottom: 2.5rem;
    padding-top: 1rem;
}

.card-logo {
    height: 48px;
    width: auto;
    object-fit: contain;
    filter: drop-shadow(0 0 6px rgba(245, 200, 66, 0.5));
}

.card-subtitle {
    font-size: 0.55rem;
    color: #a89060;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.card-photo-wrap {
    position: relative;
    flex: 1;
    overflow: hidden;
}

.card-photo-shadow {
    position: absolute;
    inset: 0;
    box-shadow: inset 0 60px 40px rgba(0,0,0,0.7), inset 0 -60px 40px rgba(0,0,0,0.7);
    pointer-events: none;
    z-index: 1;
}

.card-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top;
}

.card-name-banner {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 2;
    background: linear-gradient(0deg, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.6) 100%);
    padding: 8px 6px 6px;
    text-align: center;
    font-size: 0.75rem;
    font-weight: 900;
    color: #f0e0a0;
    letter-spacing: 2px;
    text-shadow: 0 1px 4px rgba(0,0,0,0.9);
}

.card-stats {
    display: flex;
    align-items: flex-start;
    justify-content: space-around;
    padding: 10px 6px 8px;
    background: linear-gradient(180deg, rgba(10,6,2,0.95) 0%, rgba(20,12,4,0.98) 100%);
    border-top: 2px solid var(--clan-color, #b59a4f);
    gap: 4px;
}

.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    flex: 1;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: radial-gradient(circle, #2a1c08 0%, #0d0a04 100%);
    border: 2px solid var(--clan-color, #b59a4f);
    box-shadow: 0 0 8px color-mix(in srgb, var(--clan-color, #b59a4f) 50%, transparent),
                inset 0 1px 4px rgba(0,0,0,0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.stat-level-badge {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.stat-level-num {
    font-size: 1rem;
    font-weight: 900;
    color: #f5c842;
    line-height: 1;
    text-shadow: 0 0 6px rgba(245, 200, 66, 0.8);
}

.stat-label {
    font-size: 0.6rem;
    color: #c8a860;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.stat-value {
    font-size: 0.6rem;
    color: #f0e0a0;
    font-weight: 600;
    text-align: center;
    max-width: 70px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.stat-divider {
    width: 1px;
    height: 36px;
    background: color-mix(in srgb, var(--clan-color, #b59a4f) 40%, transparent);
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 3px 8px;
    background: rgba(0,0,0,0.6);
    border-top: 1px solid rgba(180,150,70,0.2);
}

.rarity {
    font-size: 0.5rem;
    color: #a89060;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.holographic {
    color: #f5c842;
    text-shadow: 0 0 6px rgba(245, 200, 66, 0.8);
}

.copyright {
    font-size: 0.45rem;
    color: #6b5a30;
}

/* VERSO */
.back-content {
    padding: 20px 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
}

.back-logo {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    border: 2px solid var(--clan-color, #b59a4f);
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0,0,0,0.5);
    box-shadow: 0 0 12px color-mix(in srgb, var(--clan-color, #b59a4f) 40%, transparent);
}

.back-name {
    font-size: 1rem;
    font-weight: 900;
    color: #f0e0a0;
    letter-spacing: 1px;
    text-align: center;
    text-transform: uppercase;
}

.back-clan {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 14px;
    border-radius: 999px;
    border: 1px solid;
    background: rgba(0,0,0,0.4);
    font-size: 0.75rem;
    font-weight: 600;
}

.back-stats {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.back-stat {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.back-stat-label {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.back-stat-bar {
    width: 100%;
    height: 8px;
    background: rgba(255,255,255,0.1);
    border-radius: 999px;
    overflow: hidden;
}

.back-stat-fill {
    height: 100%;
    border-radius: 999px;
    transition: width 0.5s ease;
}

.back-stat-num {
    font-size: 0.7rem;
    font-weight: 700;
    text-align: right;
}

.leader-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(245, 200, 66, 0.15);
    border: 1px solid #f5c842;
    border-radius: 999px;
    padding: 4px 14px;
    font-size: 0.7rem;
    color: #f5c842;
    font-weight: 700;
    letter-spacing: 1px;
}

.back-footer {
    margin-top: auto;
    font-size: 0.45rem;
    color: #6b5a30;
    letter-spacing: 0.5px;
}
</style>
