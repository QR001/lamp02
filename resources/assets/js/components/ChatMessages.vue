<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in message">
            <div class="header">
                <strong class="primary-font">
                    {{ message.user.name }}
                </strong>
            </div>
            <p>
                {{ message.message }}
            </p>
        </li>
    </ul>
</template>

<script>
    export default {
        props:['message']
    };
</script>