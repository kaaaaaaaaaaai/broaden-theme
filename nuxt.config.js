module.exports = {
	srcDir: 'client/',
	generate: {
		dir:'client/htdocs'
    },
    head: {
        titleTemplate: '%s - Nuxt.js',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: 'Meta description' }
        ]
    },
    css:[
	    '~/static/app.css'
    ],
    // plugins:[
    //     '~/static/app.js'
    // ],
    render: {
        bundleRenderer: {
            shouldPreload: (file, type) => {
                return ['script', 'style', 'font'].includes(type)
            }
        }
    },
    build: {
        vendor: ['axios']
    }

}