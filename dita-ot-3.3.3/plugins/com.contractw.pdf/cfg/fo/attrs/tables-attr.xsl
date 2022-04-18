<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format" version="2.0">

  <xsl:attribute-set name="__tableframe__bottom" use-attribute-sets="table.border__bottom">
    <xsl:attribute name="border-after-width.conditionality">retain</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="thead__tableframe__bottom" use-attribute-sets="table.border__bottom">
  </xsl:attribute-set>

  <xsl:attribute-set name="table__tableframe__bottom" use-attribute-sets="table.border__bottom">
  </xsl:attribute-set>

  <xsl:attribute-set name="table__tableframe__all" use-attribute-sets="table__tableframe__topbot table__tableframe__sides">
    <xsl:attribute name="border-before-width.conditionality">retain</xsl:attribute>
    <xsl:attribute name="border-after-width.conditionality">retain</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="table__tableframe__topbot" use-attribute-sets="table__tableframe__top table__tableframe__bottom">
    <xsl:attribute name="border-before-width.conditionality">retain</xsl:attribute>
    <xsl:attribute name="border-after-width.conditionality">retain</xsl:attribute>
  </xsl:attribute-set>

</xsl:stylesheet>