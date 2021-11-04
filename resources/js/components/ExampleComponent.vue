<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Link Shortner</div>

                    <div class="card-body">
                        <input v-model="url" placeholder="отредактируй меня">
                        <button id="button" @click="urlSend">Click</button>
                        <a :href="new_url" target="_blank">{{new_url}}</a>
                        <p>{{errors}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url: '',
                errors: '',
                new_url: ''
            }
        },
        methods: {
            async urlSend() {
                this.new_url = '';
                this.errors = '';
                document.querySelector('#button').disabled = true;
                await window.axios.post('/api/link-generate', {url: this.url}).
                then(data => {
                    this.new_url = document.location.href + data.data.code;
                    document.querySelector('#button').disabled = false;
                }).catch(data => {
                    this.errors = data.response.data.errors ? data.response.data.errors.url[0] : data.response.data.message;
                    document.querySelector('#button').disabled = false;
                });
            }
        }
    }
</script>
