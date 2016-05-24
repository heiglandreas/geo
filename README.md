# Org\Heigl\Geo

[![Build Status](https://travis-ci.org/heiglandreas/geo.svg?branch=master)](https://travis-ci.org/heiglandreas/geo)
[![Coverage Status](https://coveralls.io/repos/github/heiglandreas/geo/badge.svg?branch=master)](https://coveralls.io/github/heiglandreas/geo?branch=master)


This Module contains Classes to handle Geolocation-Data

[Documentation](https://heiglandreas.github.io/geo/)

## Usage

The main Part is the Point-Class that references any Point by 
Latitude/Longitude.

Multiple points can be combined to a Polygon and multiple Polygons can be 
combined to a Shape.

Such a Polygon or a Shape has a bounding box defined as a Rectangle.

Thats it.

Nothing more.

Oh, and you can convert such a Shape (or multiple shapes if you want) to an SVG
via Shape::render() by providing an instance of the Svg-Renderer.

## Requirements

This Package requires at least PHP >= 5.3

## Installation

    composer require org_heigl/geo
