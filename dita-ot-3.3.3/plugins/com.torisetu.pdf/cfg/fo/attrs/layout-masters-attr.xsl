<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="2.0">

  <xsl:attribute-set name="region-body__backcover.last" use-attribute-sets="region-body.odd">
      <fo:region-before region-name="odd-body-header" xsl:use-attribute-sets="region-before"/>
      <fo:region-after region-name="odd-body-footer" xsl:use-attribute-sets="region-after"/>
  </xsl:attribute-set>
  <xsl:attribute-set name="region-body__backcover.odd" use-attribute-sets="region-body.odd">
      <fo:region-before region-name="odd-body-header" xsl:use-attribute-sets="region-before"/>
      <fo:region-after region-name="odd-body-footer" xsl:use-attribute-sets="region-after"/>
  </xsl:attribute-set>
  <xsl:attribute-set name="region-body__backcover.even" use-attribute-sets="region-body.even">
      <fo:region-before region-name="even-body-header" xsl:use-attribute-sets="region-before"/>
      <fo:region-after region-name="even-body-footer" xsl:use-attribute-sets="region-after"/>
  </xsl:attribute-set>

</xsl:stylesheet>