<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format" version="2.0">

  <xsl:attribute-set name="__tableframe__top" use-attribute-sets="common.border">
  </xsl:attribute-set>

  <xsl:attribute-set name="__tableframe__bottom" use-attribute-sets="common.border">
    <xsl:attribute name="border-after-width.conditionality">retain</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="thead__tableframe__bottom" use-attribute-sets="common.border">
  </xsl:attribute-set>

  <xsl:attribute-set name="__tableframe__left" use-attribute-sets="common.border">
  </xsl:attribute-set>

  <xsl:attribute-set name="__tableframe__right" use-attribute-sets="common.border">
  </xsl:attribute-set>

</xsl:stylesheet>