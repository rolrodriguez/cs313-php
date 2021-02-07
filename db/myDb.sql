

/*
 *	SQL script: creates tables for journal application
 *
 *  @author: Rolando Rodriguez
 *  @created: 2020-01-30
 * */

-- Add postgress extension to generate UUIDs
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";


-- Drop tables to start from scratch
drop table if exists VaultBucketsEntries;
drop table if exists VaultBuckets;
drop table if exists journalentries;
drop table if exists journals;
drop table if exists users;

/*
 * Users table
 * 
 * Table to store the details of each user
 * userids will be generated using uuid_generate_v4 function
 * */

-- Create users table
CREATE TABLE users (
  userid 			uuid default uuid_generate_v4() primary key,
  username 			varchar(40) not null unique,
  password 			text not NULL,
  createdon 		timestamp not null, 
  lastloggedon 		timestamp not null,
  lastmodifiedon 	timestamp not null
);

/*
 * Journals table
 * 
 * Table to record main details about each journal created in the app
 * */

-- Create users table
CREATE TABLE journals (
	journalid serial primary key,
	userid uuid not null references users(userid),
	journalname varchar(50) not null,
	journaldescription varchar(100),
	createdon timestamp not null,
	lastmodifiedon timestamp not null
);

/*
 * JournalsEntries table
 * 
 * Table to record entries to the journal
 * */

-- Create journalentries table
CREATE TABLE JournalEntries (
	journalentryid serial primary key,
	journalid int not null references journals(journalid),
	entrytitle varchar(40) not null,
	entrytext text not null,
	createdon timestamp not null,
	lastmodifiedon timestamp not null
);

/*
 * VaultBuckets table
 * 
 * Table to record spaces for data related to the entries
 * these are the vault buckets
 * */

-- Create VaultBuckets table
CREATE TABLE VaultBuckets (
	vaultid serial primary key,
	userid uuid not null references users(userid),
	vaultname varchar(40) not null,
	createdon timestamp not null,
	lastmodifiedon timestamp not null
);

/*
 * VaultBucketsEntries table
 * 
 * Table to record spaces for data related to the entries
 * these are the vault buckets
 * */

-- Create VaultBuckets table
CREATE TABLE VaultBucketsEntries (
	bucketEntryID serial primary key,
	vaultid int not null references VaultBuckets(vaultid),
	recorddate date not null,
	value text not null,
	comment text,
	createdon timestamp not null,
	lastmodifiedon timestamp not null
);


/*
 * Dummy data for the tables
 * */

-- add extension to save sha256 of dummy password

create extension if not exists pgcrypto;

-- creating a user
insert into users (username, "password", createdon, lastloggedon, lastmodifiedon) 
values ('admin', encode(digest('admin', 'sha256'), 'hex'), now(), now(), now());

-- creating a journal

insert into journals (userid, journalname, journaldescription, createdon, lastmodifiedon) 
values ((select userid from users where username = 'admin'), 'My Japanese learning journal', 
'This journal will include my daily notes about my journey to learn japanese', now(), now());

-- creating a journal entry

insert into journalentries (journalid, entrytitle, entrytext, createdon, lastmodifiedon) 
values ((select journalid from journals where journalname = 'My Japanese learning journal')
, 'Starting japanese, learning hiragana', 'This is my first day learning the language, I downloaded some practice sheets to practice hiragana, I filled three pages', 
now(), now());

-- creating a vault bucket

insert into vaultbuckets (userid, vaultname, createdon, lastmodifiedon) 
values ((select userid from users where username = 'admin'), 'difficult words', now(), now());

-- creating a vault bucket entry

insert into vaultbucketsentries (vaultid, recorddate, value, "comment", createdon, lastmodifiedon)
values ((select vaultid from vaultbuckets where vaultname = 'difficult words'), '2020-01-06', 
'ohayou gozaimasu', 'This word is used frequently', now(), now()); 







