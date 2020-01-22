<template>
    <div class="d-flex justify-content-center">
        <form class="d-inline-flex flex-row-reverse p-3">
            <template v-for="value in [5, 4, 3, 2, 1]">
                <input type="radio"
                       name="stars"
                       :id="value"
                       :value="value"
                       v-model="rating"
                       :key="`input-${value}`"
                       @change="submit"/>
                <label class="fa fa-star" :for="value" :key="`label-${value}`"></label>
            </template>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                rating: this.initialRating,
            };
        },

        props: {
            initialRating: {
                type: Number,
                required: true,
            },

            route: {
                type: String,
                required: true,
            },
        },

        methods: {
            submit() {
                axios.patch(this.route, {
                    rating: this.rating,
                });
            },
        },
    };
</script>

<style lang="scss" scoped>
    $size: 1.5rem;

    input, label {
        -webkit-tap-highlight-color: rgba(0,0,0,0);
    }

    input {
        display: none;

        &:checked ~ label {
            color: #FFDB19;
            animation: wobble 0.8s ease-out;
        }
    }

    label {
        width: $size;
        height: $size;
        font-size: $size;
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
