import * as fs from 'fs';
import * as path from 'path';
import * as mysql from 'mysql2/promise';

const dbConfig = {
  host: 'localhost',
  user: 'root',
  password: '',
  database: '2dekansveilingen',
};

async function migrateDatabase() {
  const connection = await mysql.createConnection(dbConfig);

  try {
    await connection.query(`DROP DATABASE IF EXISTS ${dbConfig.database}`);
    await connection.query(`CREATE DATABASE ${dbConfig.database}`);
    await connection.end();

    const newDbConfig = { ...dbConfig, database: dbConfig.database };
    const newConnection = await mysql.createConnection(newDbConfig);

    const schemaPath = path.join(__dirname, 'schema.sql');
    const schemaSql = fs.readFileSync(schemaPath, 'utf-8');

    const sqlStatements = schemaSql.split(';');

    for (const statement of sqlStatements) {
      if (statement.trim() !== '') {
        await newConnection.query(statement);
      }
    }

    console.log('Database reset and schema imported successfully.');
  } catch (error) {
    console.error('Error resetting the database:', error);
  } finally {
    await connection.end();
  }
}

migrateDatabase();
