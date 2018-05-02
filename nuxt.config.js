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
            '~/static/app.js'
        ]
    },
    css:[
	    '~/static/app.css'
    ],
    render: {
        bundleRenderer: {
            shouldPreload: (file, type) => {
                return ['script', 'style', 'font'].includes(type)
            }
        }
    },
    build: {
        vendor: ['axios']
    },
    //  cache: true,
    env:{
        apiUrl: process.env.FRONT_API_URL || 'http://api.domain.com',
    },
    modules: [
        // Simple usage
        'nuxt-buefy'
    ]
}