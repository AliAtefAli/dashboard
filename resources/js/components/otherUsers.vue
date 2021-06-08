<template>
    <div>
        <div class="card-body chat-fixed-search">
            <fieldset class="form-group position-relative has-icon-left m-0">
                <input type="text" class="form-control" id="iconLeft4" placeholder="ابحث عن مستخدم" v-model="q">
                <div class="form-control-position">
                    <i class="ft-search"></i>
                </div>
            </fieldset>
        </div>

        <div id="users-list" class="list-group position-relative" v-if="users.length > 0">
            <div class="users-list-padding media-list">

                <a :href="require(`images/image-${user.id}`)" class="media border-0 bg-blue-grey bg-lighten-5 " v-for="user in users">
                    <div class="media-left pr-1">
                        <span class="avatar avatar-md avatar-online">
                            <img class="media-object rounded-circle" :src="require(`${user.image}`)"
                                 alt="">
                        </span>
                    </div>
                    <div class="media-body">
                        <h6 class="list-group-item-heading">{{ user.name }}</h6>

                        <span class="float-right primary">
                            <span :id="`require(${ user.id}`" class="badge badge-pill badge-danger message-count"></span>
                        </span>
                    </div>
                </a>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            q: "",
            users: []
        };
    },

    created() {
        // axios.get("/searchAjax" + this.q).then(response => {
        //   console.log(response.data);
        // });
    },

    watch: {
        q() {
            if (this.q.length >= 3) {
                this.searchUsers();
            }
        }
    },
    methods: {
        searchUsers: _.debounce(function() {
            if (this.q !== "") {
                axios.get("/searchAjax/" + this.q).then(response => {
                    console.log(response.data);
                    this.users = response.data;
                });
            }
        }, 1000)
    }
};
</script>

