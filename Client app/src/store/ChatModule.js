import {chats} from "../api/chat";
import {sendMessage , messages} from "../api/message";

const ChatModule = {
  state: {
    chats: {},
      messages: []
  },
  mutations: {
    setChats (state, payload) {
      state.chats = payload
    },
      loadMessages(state, payload) {
          messages(payload.user1, payload.user2)
              .then(res => {
                  state.messages = res.data.data.messages
              }).catch(err => {

              })
      },
      appendMessage(state, message) {
          state.messages.push(message)
          console.log(state.messages)
      }
  },
  actions: {
    sendMessage (state, payload) {
        let chatID = payload.chatID
        const message = {
            recipient_id: chatID,
            message: payload.content,
        }

        sendMessage(message)
            .then((res) => {
                state.commit('appendMessage', res.data.data.message)
            }).catch(err => {

            })
    },
    loadUserChats (context) {
      let user = context.getters.user
        chats().then(res => {
            let chats = res.data.data.chats
            context.commit('setChats', chats)
        }).catch(err => {

        })
    }
  },
  getters: {
    chats (state) {
      return state.chats
    },
      chatMessages(state) {
        return state.messages
      }
  }
}

export default ChatModule
