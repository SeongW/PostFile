package org.model;

import javax.persistence.Column;
import javax.persistence.Id;
import java.io.Serializable;

/**
 * Created by wujiacheng on 16/6/6.
 */
public class CjbEntityPK implements Serializable {
    private String xh;
    private String kch;

    @Column(name = "xh", nullable = false, length = 6)
    @Id
    public String getXh() {
        return xh;
    }

    public void setXh(String xh) {
        this.xh = xh;
    }

    @Column(name = "kch", nullable = false, length = 3)
    @Id
    public String getKch() {
        return kch;
    }

    public void setKch(String kch) {
        this.kch = kch;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        CjbEntityPK that = (CjbEntityPK) o;

        if (xh != null ? !xh.equals(that.xh) : that.xh != null) return false;
        if (kch != null ? !kch.equals(that.kch) : that.kch != null) return false;

        return true;
    }

    @Override
    public int hashCode() {
        int result = xh != null ? xh.hashCode() : 0;
        result = 31 * result + (kch != null ? kch.hashCode() : 0);
        return result;
    }
}
