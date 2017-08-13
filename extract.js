#!/usr/bin/env node

const mysql = require('promise-mysql')
const config = require('./db_config')
const fs = require('fs')

const RESULT_FILENAME = 'result.json'

async function main() {
  try {
    var connection = await mysql.createConnection(config)
    const peoples = await getSiteContent(19)
    const brands = await getSiteContent(20)
    const manual = await getSiteContent(22)
    const news = await getSiteContent(24)
    const defence = await getSiteContent(25)
    const serm = await getSiteContent(26)

    fs.writeFileSync(RESULT_FILENAME, JSON.stringify({
      peoples,
      brands,
      manual,
      news,
      defence,
      serm
    }))
    console.log('done')
    process.exit(1)
  }
  catch (e) {
    console.log(e)
    process.abort()
  }
  async function getSiteContent(parentID) {
    return await connection.query('SELECT * FROM zxvdf_site_content where parent=' + parentID)
  }
}

main()
