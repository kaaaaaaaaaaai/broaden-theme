require('dotenv').config();
module.exports = {
	srcDir: 'client/',
	generate: {
		dir:'client/htdocs'
    },
    head: {
        titleTemplate: '%seeee - Nuxt.js',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: 'Meta description' }
        ],
        script: [
            // { src: '~/static/app.js' }
            { src: 'https://use.fontawesome.com/releases/v5.0.7/js/all.js', defer: true }

        ]
    },
    render: {
        bundleRenderer: {
            shouldPreload: (file, type) => {
                return ['script', 'style', 'font'].includes(type)
            }
        }
    },


    axios: {
        baseURL:process.env.FRONT_API_URL,
    },
    //  cache: true,
    env:{
        apiUrl: process.env.FRONT_API_URL || 'http://api.domain.com',
    },
    modules: [
        // Simple usage
        'nuxt-buefy',
        "@nuxtjs/axios"
    ]
}
