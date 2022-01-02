import axios from "axios";
//TOKEN WKYNj1jSLBZ8vqE1I2S4b7TV8Dsb12yJV3HhzuDi

const apiClient = axios.create({
    baseURL: 'http://casteaching.test/api',
    withCredentials: true,
    headers:{
        Accept: 'application/json',
        'Content-Type': 'application/json',
        Authorization: 'Bearer WKYNj1jSLBZ8vqE1I2S4b7TV8Dsb12yJV3HhzuDi'
    }
})
export default{
    videos: async function (){
        const response = await apiClient.get('/videos')
        return response.data;
    },
    video: {
        show: async function (id) {
            const response = await apiClient.get('/videos/' + id)
            return response.data;
        },
        create: async function (data) {
            const response = await apiClient.post('/videos', data)
            return response.data;
        },
        update: async function (id,data) {
            const response = await apiClient.put('/videos/' + id ,data)
            return response.data;
        },
        destroy: async function (id) {
            const response = await apiClient.delete('/videos/' + id)
            return response.data;
        },

    }
}
