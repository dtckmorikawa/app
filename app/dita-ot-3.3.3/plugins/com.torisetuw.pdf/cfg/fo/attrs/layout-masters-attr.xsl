<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="2.0">

  <xsl:attribute-set name="region-body__backcover.last" use-attribute-sets="region-body.odd">
  </xsl:attribute-set>
  <xsl:attribute-set name="region-body__backcover.odd" use-attribute-sets="region-body.odd">
  </xsl:attribute-set>
  <xsl:attribute-set name="region-body__backcover.even" use-attribute-sets="region-body.even">
  </xsl:attribute-set>

  <xsl:attribute-set name="region-body.first">
    <xsl:attribute name="margin-top">
      <xsl:value-of select="$page-margin-top-first"/>
    </xsl:attribute>
    <xsl:attribute name="margin-bottom">
      <xsl:value-of select="$page-margin-bottom"/>
    </xsl:attribute>
    <xsl:attribute name="{if ($writing-mode = 'lr') then 'margin-left' else 'margin-right'}">
      <xsl:value-of select="$page-margin-inside"/>
    </xsl:attribute>
    <xsl:attribute name="{if ($writing-mode = 'lr') then 'margin-right' else 'margin-left'}">
      <xsl:value-of select="$page-margin-outside"/>
    </xsl:attribute>
    <!--Watermark-->
    <xsl:attribute name="background-image">url(Customization/OpenTopic/common/artwork/Sample.png)</xsl:attribute>
    <xsl:attribute name="background-repeat">no-repeat</xsl:attribute>
    <xsl:attribute name="background-position">-20px 0px</xsl:attribute>
  </xsl:attribute-set>

    <xsl:attribute-set name="region-body.odd">
    <xsl:attribute name="margin-top">
      <xsl:value-of select="$page-margin-top"/>
    </xsl:attribute>
    <xsl:attribute name="margin-bottom">
      <xsl:value-of select="$page-margin-bottom"/>
    </xsl:attribute>
    <xsl:attribute name="{if ($writing-mode = 'lr') then 'margin-left' else 'margin-right'}">
      <xsl:value-of select="$page-margin-inside"/>
    </xsl:attribute>
    <xsl:attribute name="{if ($writing-mode = 'lr') then 'margin-right' else 'margin-left'}">
      <xsl:value-of select="$page-margin-outside"/>
    </xsl:attribute>
    <!--Watermark-->
    <xsl:attribute name="background-image">url(Customization/OpenTopic/common/artwork/Sample.png)</xsl:attribute>
    <xsl:attribute name="background-repeat">no-repeat</xsl:attribute>
    <xsl:attribute name="background-position">-20px 0px</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="region-body.even">
    <xsl:attribute name="margin-top">
      <xsl:value-of select="$page-margin-top"/>
    </xsl:attribute>
    <xsl:attribute name="margin-bottom">
      <xsl:value-of select="$page-margin-bottom"/>
    </xsl:attribute>
    <xsl:attribute name="{if ($writing-mode = 'lr') then 'margin-left' else 'margin-right'}">
      <xsl:value-of select="$page-margin-outside"/>
    </xsl:attribute>
    <xsl:attribute name="{if ($writing-mode = 'lr') then 'margin-right' else 'margin-left'}">
      <xsl:value-of select="$page-margin-inside"/>
    </xsl:attribute>
    <!--Watermark-->
    <xsl:attribute name="background-image">url(Customization/OpenTopic/common/artwork/Sample.png)</xsl:attribute>
    <xsl:attribute name="background-repeat">no-repeat</xsl:attribute>
    <xsl:attribute name="background-position">-20px 0px</xsl:attribute>
  </xsl:attribute-set>


</xsl:stylesheet>