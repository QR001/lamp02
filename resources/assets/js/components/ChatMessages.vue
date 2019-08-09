<template>
    <ul class="chat">
        <li class="left clearfix" v-for-key="messages in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        {{ message.user.name }}
                    </strong>
                </div>
            <p>
                {{ message.message }}
            </p>
            </div>
        </li>
    </ul>
</template>

<script>
//  import Pusher from 'pusher-js';
//  import '../../../assets/js/components/ChatMessages.vue'

    export default {
        props:['messages']
    };
</script>