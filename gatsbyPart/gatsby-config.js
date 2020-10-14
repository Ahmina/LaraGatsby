  /**
 * Configure your Gatsby site with this file.
 *
 * See: https://www.gatsbyjs.org/docs/gatsby-config/
 */

module.exports = {
  /* Your site config here */
  siteMetadata: {
    title: `مدونة AHMINA Marouan`,
    siteUrl: `https://localhost:8000`,
    description: `Test description sitemeta`,
    author: 'Merro'
  },  
  plugins: [
    `gatsby-plugin-netlify`,
    `gatsby-transformer-sharp`,
    `gatsby-plugin-sharp`,
    `gatsby-plugin-react-helmet`,
    `gatsby-transformer-json`,
    {
      resolve: `gatsby-source-filesystem`,
      options: {
        path: `${__dirname}/src/posts`,
      },
    },
    {
      resolve: `gatsby-transformer-remark`,
      options: {
      plugins: [{
        resolve: `gatsby-remark-prismjs`,
      },
      {
        resolve: `gatsby-remark-images`,
        options: {
          maxWidth: 800,
          
        },
      },
      ]
      }
    },
    {
      resolve: `gatsby-source-filesystem`,
      options: {
        name: `posts`,
        path: `${__dirname}/src/posts`,
      },
    },
  ],
}