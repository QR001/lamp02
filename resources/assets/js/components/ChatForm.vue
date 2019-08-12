<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-controller inut-sm" placeholder="输入要发送的消息..." v-model="newMessage" @keyup.enter="sendChat">

        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendChat">
                发送
            </button>
        </span>
    </div>
</template>

<script>
    export default{
        props:['user'],
        data(){
            return {
                newMessage:''
            }
        },
        methods:{
            sendChat(){
                this.$emit('messagesent',{
                    user:this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }
    }
</script>