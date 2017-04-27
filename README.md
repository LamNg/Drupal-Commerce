# Shopify to Drupal Commerce Migration Modules

## Introduction

The module migrates Shopify Products, Customers, and Orders exports (.csv) into Drupal Commerce and handle data transformations during the migration process. It is built upon existing Drupal Migrate and Commerce Migrate modules and supports the latest version of Drupal Commerce, Drupal Commerce 2.x.

## Installation

Clone the repo in the you Drupal Modules folder:

`git clone git@github.com:LamNg/Drupal-Commerce.git`

Rename the folder the folder to 'custom':

`mv Drupal-Commerce custom`  

Replace the data under `shopify_*/data` with your Shopify exported data.

Install the modules using Drupal.

## Usage

List all migration:

`drush ms`

Run all migrations:

`drush mi --all`

Run specific migration group:

`drush mi --group={migration group's name}`
