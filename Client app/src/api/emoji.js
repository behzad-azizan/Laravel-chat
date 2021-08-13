
import axios from "axios";

const http = axios.create();
export const emojis = () => {
    return http.get('https://raw.githubusercontent.com/shanraisshan/EmojiCodeSheet/master/json/string/People.json')
}
