<template>
    <div class="card-body">
        <h1>Create a contest</h1>

        <form @submit.prevent>
            <div class="form-group">
                <label for="name">Contest name</label>
                <input type="text"
                       class="form-control"
                       id="name"
                       placeholder="Name of your contest"
                       v-model="name">
                <small class="form-text text-muted">Please provide the name of your design contest.</small>
            </div>

            <div class="form-group">
                <label for="name">Contest description</label>
                <textarea class="form-control"
                          id="description"
                          rows="5"
                          placeholder="Briefing of your contest"
                          v-model="description">
                </textarea>
                <small class="form-text text-muted">Please provide a short briefing for your design contest.</small>
            </div>

            <div class="form-group">
                <label for="expiration">Expires in</label>
                <select class="form-control" id="expiration" v-model.number="expiration">
                    <option value="1">1 week</option>
                    <option value="2">2 weeks</option>
                    <option value="3">3 weeks</option>
                    <option value="4">4 weeks</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" @click="submit">Next</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                description: '',
                expiration: 1,
                name: '',
            };
        },

        methods: {
            submit() {
                axios.post('/contests', {
                    description: this.description,
                    expiration: this.expiration,
                    name: this.name,
                }).then((response) => {
                    console.log(response);

                    this.$emit('next');
                }).catch((error) => {
                    // Validation errors,
                    console.log(error.response.data.errors);
                });
            },
        },
    };
</script>
