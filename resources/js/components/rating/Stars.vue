<template>
    <div class="d-flex justify-content-center" :class="{ locked }">
        <form class="d-inline-flex flex-row-reverse p-2">
            <template v-for="value in [5, 4, 3, 2, 1]">
                <input type="radio"
                       name="stars"
                       :id="value + id"
                       :value="value"
                       :key="`input-${value}`"
                       :disabled="locked"
                       v-model="rating"
                       @change="submit"/>
                <label :class="star(value)" :for="value + id" :key="`label-${value}`"/>
            </template>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                id: Math.random(),
                rating: this.initialRating,
            };
        },

        props: {
            editable: {
                required: true,
                type: Boolean,
            },

            initialRating: {
                required: true,
                type: Number,
            },

            route: {
                required: true,
                type: String,
            },
        },

        computed: {
            locked() {
                return !this.editable || this.$store.getters['contest/locked'];
            },
        },

        methods: {
            star(index) {
                return {
                    fas: index <= this.rating,
                    far: index > this.rating,
                    'fa-star': true,
                };
            },

            submit() {
                // Only allow if the contest does not have a winner yet.
                if (!this.locked) {
                    axios.patch(this.route, {
                        rating: this.rating,
                    });
                }
            },
        },
    };
</script>

<style lang="scss" scoped>
    $size: 1.5rem;

    .locked {
        label {
            cursor: default;
        }
    }

    input, label {
        -webkit-tap-highlight-color: rgba(0,0,0,0);
    }

    input {
        display: none;

        &:checked ~ label {
            color: #ffcf19;
            animation: wobble 0.8s ease-out;
        }
    }

    label {
        width: $size;
        height: $size;
        font-size: $size - 0.3rem;
        cursor: pointer;
        color: #d0d0d0;
        transition: color 0.1s ease-out;
        margin: 0;
    }

    @keyframes wobble {
        0% { transform: scale(0.8); }
        20% { transform: scale(1.1); }
        40% { transform: scale(0.9); }
        60% { transform: scale(1.05); }
        80% { transform: scale(0.96); }
        100% { transform: scale(1); }
    }
</style>
